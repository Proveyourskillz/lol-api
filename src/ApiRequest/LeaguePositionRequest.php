<?php namespace Likewinter\LolApi\ApiRequest;

use Likewinter\LolApi\Mapper\LeaguePositionMapper;

class LeaguePositionRequest extends AbstractRequest implements ApiRequestInterface
{
    protected $mapperClass = LeaguePositionMapper::class;

    protected $type = 'league';
    protected $version = 3;

    protected $summonerId;
    protected $region;

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

    public static function bySummonerId(string $region, int $summonerId)
    {
        return new static($region, $summonerId);
    }


    public function getSubtypes(): array
    {
        return ['positions/by-summoner' => $this->summonerId];
    }


}