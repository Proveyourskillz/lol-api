<?php namespace PYS\LolApi;

use PYS\LolApi\Exceptions\WrongRequestException;
use PYS\LolApi\Models\LeagueModel;
use PYS\LolApi\Models\LeaguePositionModel;
use PYS\LolApi\Models\MatchListModel;
use PYS\LolApi\Models\MatchModel;
use PYS\LolApi\Models\SummonerModel;

/**
 * @method SummonerModel summoner(string $region, $value, string $credential = 'summoner')
 * @method MatchModel match(string $region, int $matchId, ?int $tournamentId = null)
 * @method MatchListModel matchList(string $region, int $accountId, array $query = [])
 * @method LeaguePositionModel leaguePosition(string $region, int $summonerId)
 * @method LeagueModel league(string $region, int $summonerId)
 */
trait SugarRequestsTrait
{
    public function __call($name, $args)
    {
        $class = sprintf('PYS\LolApi\ApiRequest\%sRequest', ucfirst($name));
        if (class_exists($class)) {
            return $this->make(
                new $class(...$args)
            );
        }

        throw new WrongRequestException("Request $name doesn't exists");
    }
}
