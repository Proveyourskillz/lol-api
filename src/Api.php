<?php namespace Likewinter\LolApi;

use DusanKasan\Knapsack\Collection;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Uri;
use Psr\Http\Message\ResponseInterface;

use Likewinter\LolApi\ApiRequest\ApiQueryRequestInterface;
use Likewinter\LolApi\ApiRequest\ApiRequestInterface;
use Likewinter\LolApi\ApiRequest\LeaguePositionRequest;
use Likewinter\LolApi\ApiRequest\LeagueRequest;
use Likewinter\LolApi\ApiRequest\MatchListRequest;
use Likewinter\LolApi\ApiRequest\MatchRequest;
use Likewinter\LolApi\ApiRequest\SummonerRequest;
use Likewinter\LolApi\Exceptions\Handler;
use Likewinter\LolApi\Exceptions\HandlerInterface;
use Likewinter\LolApi\Exceptions\WrongRequestException;
use Likewinter\LolApi\Models\LeaguePositionModel;
use Likewinter\LolApi\Models\MatchListModel;
use Likewinter\LolApi\Models\MatchModel;
use Likewinter\LolApi\Models\ModelInterface;
use Likewinter\LolApi\Models\SummonerModel;
use Likewinter\LolApi\Models\LeagueModel;

class Api
{
    const DEFAULT_PATH = '/lol/';
    const RATE_LIMITS_TYPE = [
        'X-Rate-Limit-Count' => 'general',
        'X-App-Rate-Limit-Count' => 'app',
        'X-Method-Rate-Limit-Count' => 'method',
    ];
    const PLATFORMS_ENDPOINTS = [
        'BR1' => 'br1.api.riotgames.com',
        'EUN1' => 'eun1.api.riotgames.com',
        'EUW1' => 'euw1.api.riotgames.com',
        'JP1' => 'jp1.api.riotgames.com',
        'KR' => 'kr.api.riotgames.com',
        'LA1' => 'la1.api.riotgames.com',
        'LA2' => 'la2.api.riotgames.com',
        'NA1' => 'na1.api.riotgames.com',
        'OC1' => 'oc1.api.riotgames.com',
        'TR1' => 'tr1.api.riotgames.com',
        'RU' => 'ru.api.riotgames.com',
        'PBE1' => 'pbe1.api.riotgames.com',
    ];
    const REGIONS_PLATFORMS = [
        'BR' => 'BR1',
        'EUNE' => 'EUN1',
        'EUW' => 'EUW1',
        'JP' => 'JP1',
        'KR' => 'KR',
        'LAN' => 'LA1',
        'LAS' => 'LA2',
        'NA' => 'NA1',
        'OCE' => 'OC1',
        'TR' => 'TR1',
        'RU' => 'RU',
        'PBE' => 'PBE1',
    ];
    /**
     * @var string
     */
    private $apiKey;
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
     * @var HandlerInterface
     */
    private $exceptionHandler;

    /**
     * Api constructor.
     *
     * @param string $apiKey
     */
    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
        $this->http = $this->setupHttpClient();
        $this->endpointURI = new Uri('https:');
        $this->exceptionHandler = new Handler();
    }

    public function make(ApiRequestInterface $apiRequest): ModelInterface
    {
        $uri = $this->getUriForRequest($apiRequest);
        $options = [];
        if ($apiRequest instanceof ApiQueryRequestInterface) {
            $options['query'] = $apiRequest->getQuery();
        }
        try {
            $response = $this->http->get($uri, $options);
            $this->setRateLimits($response);

            return $apiRequest
                ->getMapper()
                ->map(\GuzzleHttp\json_decode($response->getBody()))
                ->wireRegion($apiRequest->getRegion())
                ->wireApi($this);
        } catch (RequestException $requestException) {
            $this->exceptionHandler->handle($requestException, $apiRequest);
        }
    }

    public function makeSummoner(SummonerRequest $summonerRequest): SummonerModel
    {
        $summoner = $this->make($summonerRequest);
        if (!$summoner instanceof SummonerModel) {
            throw (new WrongRequestException())
                ->setMethodAndRequest('makeSummoner', 'SummonerRequest');
        }

        return $summoner;
    }

    public function makeMatchList(MatchListRequest $matchListRequest): MatchListModel
    {
        $matchList = $this->make($matchListRequest);
        if (!$matchList instanceof MatchListModel) {
            throw (new WrongRequestException())
                ->setMethodAndRequest('makeMatchList', 'MatchListRequest');
        }

        return $matchList;
    }

    public function makeMatch(MatchRequest $matchRequest): MatchModel
    {
        $match = $this->make($matchRequest);
        if (!$match instanceof MatchModel) {
            throw (new WrongRequestException())
                ->setMethodAndRequest('makeMatch', 'MatchRequest');
        }

        return $match;
    }

    public function makePositionLeague(LeaguePositionRequest $leaguePositionRequest): LeaguePositionModel
    {
        $league = $this->make($leaguePositionRequest);
        if (!$league instanceof LeaguePositionModel) {
            throw (new WrongRequestException())
                ->setMethodAndRequest('makePositionLeague', 'LeaguePositionRequest');
        }

        return $league;
    }

    public function makeLeague(LeagueRequest $leagueRequest): LeagueModel
    {
        $league = $this->make($leagueRequest);
        if (!$league instanceof LeagueModel) {
            throw (new WrongRequestException())
                ->setMethodAndRequest('makeLeague', 'LeagueRequest');
        }

        return $league;
    }

    public function getRateLimits(): array
    {
        return $this->rateLimits;
    }

    private function setupHttpClient(): Client
    {
        return new Client([
            'headers' => [
                'X-Riot-Token' => $this->apiKey,
            ],
        ]);
    }

    private function setRateLimits(ResponseInterface $response): void
    {
        $this->rateLimits = Collection::from($response->getHeaders())
            ->only(['X-Rate-Limit-Count', 'X-App-Rate-Limit-Count', 'X-Method-Rate-Limit-Count'])
            ->reduce(function (array $limits, array $value, string $name) {
                foreach (explode(',', $value[0]) as $limit) {
                    [$requests, $seconds] = explode(':', $limit);
                    $limits[self::RATE_LIMITS_TYPE[$name]][] = [
                        'requests' => (int)$requests,
                        'seconds' => (int)$seconds,
                    ];
                }

                return $limits;
            }, []);
    }

    private function getUriForRequest(ApiRequestInterface $apiRequest): Uri
    {
        $host = self::PLATFORMS_ENDPOINTS[$apiRequest->getPlatform()];
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

        return $this->endpointURI
            ->withHost($host)
            ->withPath($path);
    }
}
