<?php namespace PYS\LolApi\ApiRequest;

use PYS\LolApi\Mapper\LeaguePositionMapper;

class LeaguePositionRequest extends AbstractRequest implements ApiRequestInterface
{
    protected $mapperClass = LeaguePositionMapper::class;

    protected $type = 'league';
    protected $version = 3;

    protected $summonerId;

    /**
     * MatchRequest constructor.
     *
     * @param $region
     * @param $summonerId
     */
    public function __construct(string $region, int $summonerId)
    {
        $this->summonerId = $summonerId;
        $this->region = $region;
    }

    public function getSubtypes(): array
    {
        return ['positions/by-summoner' => $this->summonerId];
    }
}
