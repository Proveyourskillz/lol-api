<?php
require __DIR__ . './../vendor/autoload.php';

const API_KEY = 'RGAPI-2d373c66-30b7-42ca-8de1-12d7d999641c';

use Likewinter\LolApi\ApiRequest\SummonerRequest;
use Likewinter\LolApi\ApiRequest\MatchRequest;
use Likewinter\LolApi\ApiRequest\LeaguePositionRequest;

$api = new Likewinter\LolApi\Api(API_KEY);


#$summoner = $api->makeSummoner(SummonerRequest::bySummonerId('EUW', 19196451));
#$leagues = $summoner->leaguesPositions();

#$rq = MatchRequest::class;
#$match = $api->makeMatch(MatchRequest::byMatchId('EUW', 19196451));
$another_league = $api->makeLeague(LeaguePositionRequest::bySummonerId('EUW', 19196451));

#print_90r($leagues->leaguesPlayed);
print_r($another_league->leaguesPlayed);
#print_r($match->participantIdentities);



