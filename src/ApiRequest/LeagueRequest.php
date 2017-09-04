<?php
/**
 * Created by PhpStorm.
 * User: pilot
 * Date: 8/31/17
 * Time: 2:11 PM
 */

namespace Likewinter\LolApi\ApiRequest;
use Likewinter\LolApi\Mapper\LeagueMapper;

class LeagueRequest extends AbstractRequest implements ApiRequestInterface
{
    protected $mapperClass = LeagueMapper::class;

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

    public static function bySummonerId(string $region, int $summonerId)
    {
        return new static($region, $summonerId);
    }

    public function getSubtypes(): array
    {
        return ['leagues/by-summoner' => $this->summonerId];
    }
}
