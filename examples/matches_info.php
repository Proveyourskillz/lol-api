<?php
require __DIR__ . './../vendor/autoload.php';

const API_KEY = '>>>>ENTER-YOUR-KEY-HERE';

use Likewinter\LolApi\ApiRequest\SummonerRequest;
use Likewinter\LolApi\Models\SummonerModel;

$api = new Likewinter\LolApi\Api(API_KEY);

/** @var SummonerModel $summoner */
$summoner = $api->request(SummonerRequest::bySummonerId(19196451, 'EUW'));
$matchList = $summoner->recentMatches();

foreach ($matchList->matches as $match) {
    echo 'date: ' . date('d-m-Y H:i', $match->timestamp / 1000) . ' UTC,'
        . 'gameId: ' . $match->gameId . ', '
        . 'role: '. $match->role . "\n";
}
