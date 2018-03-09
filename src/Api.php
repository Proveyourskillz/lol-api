<?php namespace PYS\LolApi;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use function GuzzleHttp\Psr7\build_query;
use GuzzleHttp\Psr7\Uri;
use Psr\Http\Message\ResponseInterface;

use PYS\LolApi\ApiRequest\ApiQueryRequestInterface;
use PYS\LolApi\ApiRequest\ApiRequestInterface;
use PYS\LolApi\ApiRequest\Region;
use PYS\LolApi\Exceptions\RequestHandler;
use PYS\LolApi\Models\CurrentGameModel;
use PYS\LolApi\Models\ModelInterface;
use PYS\LolApi\Exceptions\WrongRequestException;
use PYS\LolApi\Models\LeagueModel;
use PYS\LolApi\Models\LeaguePositionModel;
use PYS\LolApi\Models\MatchListModel;
use PYS\LolApi\Models\MatchModel;
use PYS\LolApi\Models\SummonerModel;

/**
 * @method SummonerModel summoner(Region | string $region, $value, string $credential = 'summoner')
 * @method MatchModel match(Region | string $region, int $matchId, ?int $tournamentId = null)
 * @method MatchListModel matchList(Region | string $region, int $accountId, array $query = [])
 * @method LeaguePositionModel leaguePosition(Region | string $region, int $summonerId)
 * @method LeagueModel league(Region | string $region, int $summonerId)
 * @method CurrentGameModel currentGame(Region | string $region, int $summonerId)
 */
class Api
{
    private const DEFAULT_PATH = '/lol/';
    private const RATE_LIMITS_TYPE = [
        'X-Rate-Limit-Count' => 'general',
        'X-App-Rate-Limit-Count' => 'app',
        'X-Method-Rate-Limit-Count' => 'method',
    ];
    /**
     * @var string
     */
    private $apiKey = null;
    /*
     * @var callable
     */
    private $apiKeyCallback;
    /**
     * @var Client
     */
    private $http;
    /**
     * @var array
     */
    private $rateLimits = [];
    /**
     * @var Uri
     */
    private $endpointURI;
    /**
     * @var RequestHandler
     */
    private $exceptionHandler;

    /**
     * Api constructor.
     *
     * @param string|callable $apiKey
     */
    public function __construct($apiKey)
    {
        $this->setApiKey($apiKey);
        $this->http = new Client;
        $this->endpointURI = new Uri('https:');
        $this->exceptionHandler = new RequestHandler;
    }

    /**
     * @param $name
     * @param $args
     *
     * @return ModelInterface
     *
     * @throws Exceptions\AccessDeniedException
     * @throws Exceptions\ApiUnavailableException
     * @throws Exceptions\NotFoundException
     * @throws Exceptions\OtherRequestException
     * @throws Exceptions\RateLimitExceededException
     * @throws Exceptions\WrongParametersException
     * @throws Exceptions\WrongRequestException
     * @throws Exceptions\WrongRegion
     * @throws \ReflectionException
     */
    public function __call($name, $args)
    {
        $region = array_shift($args);
        if (!$region instanceof Region) {
            $region = new Region($region);
        }
        $class = sprintf('PYS\LolApi\ApiRequest\%sRequest', ucfirst($name));
        if (class_exists($class)) {
            return $this->make(
                $region,
                new $class(...$args)
            );
        }

        throw new WrongRequestException("Request $name doesn't exists");
    }

    /**
     * @param Region $region
     * @param ApiRequestInterface $apiRequest
     *
     * @return ModelInterface
     *
     * @throws Exceptions\AccessDeniedException
     * @throws Exceptions\ApiUnavailableException
     * @throws Exceptions\NotFoundException
     * @throws Exceptions\OtherRequestException
     * @throws Exceptions\RateLimitExceededException
     * @throws Exceptions\WrongParametersException
     * @throws \ReflectionException
     */
    public function make(Region $region, ApiRequestInterface $apiRequest): ?ModelInterface
    {
        try {
            $response = $this->http->get($this->getUriForRequest($apiRequest, $region));
            $this->setRateLimits($response);

            return $apiRequest
                ->getMapper()
                ->map(\GuzzleHttp\json_decode($response->getBody()))
                ->wireRegion($region)
                ->wireApi($this);
        } catch (RequestException $requestException) {
            $this->exceptionHandler->handle($requestException, $apiRequest);
        }

        return null;
    }

    public function getRateLimits(): array
    {
        return $this->rateLimits;
    }

    // Return null reference when serializing models, maybe fix it in future
    public function __sleep()
    {
        return [];
    }

    /**
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->apiKey ?? ($this->apiKeyCallback)();
    }

    /**
     * @param $apiKey
     */
    private function setApiKey($apiKey): void
    {
        if (is_string($apiKey)) {
            $this->apiKey = $apiKey;

            return;
        }
        if (is_callable($apiKey)) {
            $this->apiKeyCallback = $apiKey;

            return;
        }

        throw new \InvalidArgumentException('Constructor only argument must be a string or callback that return string');
    }

    private function setRateLimits(ResponseInterface $response): void
    {
        $headers = array_filter(
            $response->getHeaders(),
            function ($key) {
                return in_array(
                    $key,
                    ['X-Rate-Limit-Count', 'X-App-Rate-Limit-Count', 'X-Method-Rate-Limit-Count'],
                    true
                );
            },
            ARRAY_FILTER_USE_KEY
        );
        foreach ($headers as $name => $value) {
            foreach (explode(',', $value[0]) as $limit) {
                [$requests, $seconds] = explode(':', $limit);
                $this->rateLimits[self::RATE_LIMITS_TYPE[$name]][] = [
                    'requests' => (int)$requests,
                    'seconds' => (int)$seconds,
                ];
            }
        }
        unset($headers);
    }

    private function getUriForRequest(ApiRequestInterface $apiRequest, Region $region): Uri
    {
        $queryParams = ['api_key' => $this->getApiKey()];
        if ($apiRequest instanceof ApiQueryRequestInterface) {
            $queryParams = array_merge($queryParams, $apiRequest->getQuery()->toArray());
        }
        return $this->endpointURI
            ->withHost($region->getPlatformEndpoint())
            ->withPath($this->buildPath($apiRequest))
            ->withQuery(build_query($queryParams));
    }

    /**
     * @param ApiRequestInterface $apiRequest
     *
     * @return string
     */
    private function buildPath(ApiRequestInterface $apiRequest): string
    {
        $path = self::DEFAULT_PATH . $apiRequest->getType() . '/';
        if ($version = $apiRequest->getVersion()) {
            $path .= "v{$version}/";
        }
        foreach ($apiRequest->getSubtypes() as $subtype => $value) {
            if ($subtype) {
                $path .= $subtype . '/' . $value . '/';
            } else {
                $path .= $value . '/';
            }
        }

        return $path;
    }
}
