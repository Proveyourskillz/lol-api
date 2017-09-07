<?php
require __DIR__ . './../vendor/autoload.php';
$API_KEY = require __DIR__ . '/key.php';

use Likewinter\LolApi\ApiRequest\SummonerRequest;
use Likewinter\LolApi\ApiRequest\LeaguePositionRequest;

$api = new Likewinter\LolApi\Api($API_KEY);

$summoner = $api->makeSummoner(SummonerRequest::bySummonerId('EUW', 19196451));
$leagues = $summoner->leaguesPositions();

$another_league = $api->makeLeaguePosition(new LeaguePositionRequest('EUW', 19196451));

print_r($leagues->leaguesPlayed);
print_r($another_league->leaguesPlayed);




