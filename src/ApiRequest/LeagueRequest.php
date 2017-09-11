<?php namespace PYS\LolApi\ApiRequest;

use PYS\LolApi\Mapper\LeagueMapper;

class LeagueRequest extends AbstractRequest implements ApiRequestInterface
{
    protected static $mapperClass = LeagueMapper::class;

    protected $type = 'league';
    protected $version = 3;

    protected $summonerId;

    /**
     * MatchRequest constructor.
     *
     * @param string|Region $region
     * @param int $summonerId
     *
     * @throws \PYS\LolApi\Exceptions\WrongRegion
     */
    public function __construct($region, int $summonerId)
    {
        parent::__construct($region);

        $this->summonerId = $summonerId;
    }

    public function getSubtypes(): array
    {
        return ['leagues/by-summoner' => $this->summonerId];
    }
}
