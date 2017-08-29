<?php
require __DIR__ . './../vendor/autoload.php';

const API_KEY = 'API_KEY_HERE';

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



