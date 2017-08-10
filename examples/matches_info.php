<?php
require __DIR__ . './../vendor/autoload.php';

const API_KEY = 'API_KEY_HERE';

use Likewinter\LolApi\ApiRequest\SummonerRequest;

$api = new Likewinter\LolApi\Api(API_KEY);

$summoner = $api->makeSummoner(SummonerRequest::bySummonerId('EUW', 19196451));
$matchList = $summoner->matches([
    'beginIndex' => 0,
    'endIndex' => 1,
]);

$match = $matchList->matchByNumber(0);

echo $match->gameId . $match->gameType . $match->gameMode;
