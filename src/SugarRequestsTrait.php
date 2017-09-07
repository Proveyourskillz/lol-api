<?php namespace Likewinter\LolApi;

use Likewinter\LolApi\ApiRequest\LeaguePositionRequest;
use Likewinter\LolApi\ApiRequest\LeagueRequest;
use Likewinter\LolApi\ApiRequest\MatchListRequest;
use Likewinter\LolApi\ApiRequest\MatchRequest;
use Likewinter\LolApi\ApiRequest\SummonerRequest;
use Likewinter\LolApi\Exceptions\WrongRequestException;
use Likewinter\LolApi\Models\LeagueModel;
use Likewinter\LolApi\Models\LeaguePositionModel;
use Likewinter\LolApi\Models\MatchListModel;
use Likewinter\LolApi\Models\MatchModel;
use Likewinter\LolApi\Models\SummonerModel;

trait SugarRequestsTrait
{
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

    public function makeLeaguePosition(LeaguePositionRequest $leaguePositionRequest): LeaguePositionModel
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
}
