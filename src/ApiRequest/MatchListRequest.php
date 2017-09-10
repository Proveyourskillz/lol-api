<?php namespace PYS\LolApi\ApiRequest;

use PYS\LolApi\ApiRequest\Query\MatchListQuery;
use PYS\LolApi\ApiRequest\Query\QueryTrait;
use PYS\LolApi\Mapper\MatchListMapper;

class MatchListRequest extends AbstractRequest implements ApiQueryRequestInterface
{
    use QueryTrait;

    protected static $mapperClass = MatchListMapper::class;

    protected $type = 'match';
    protected $version = 3;

    protected $accountId;

    /**
     * MatchListRequest constructor.
     *
     * @param int $accountId
     * @param array $query
     * @param string $region
     */
    public function __construct(string $region, int $accountId, array $query = [])
    {
        $this->region = $region;
        $this->accountId = $accountId;
        $this->query = new MatchListQuery($query);
    }

    public function getSubtypes(): array
    {
        if (empty($this->query->toArray())) {
            return [
                'matchlists/by-account' => $this->accountId,
                'recent',
            ];
        }

        return ['matchlists/by-account' => $this->accountId];
    }
}
