<?php
require __DIR__ . './../vendor/autoload.php';
$API_KEY = require __DIR__ . '/key.php';

use Likewinter\LolApi\ApiRequest\LeagueRequest;
$api = new Likewinter\LolApi\Api($API_KEY);
$league = $api->makeLeague(new LeagueRequest('EUW', 19196451));

foreach ($league->leagueList as $item) {
    echo $item->name . PHP_EOL;
}
