<?php
require __DIR__ . './../vendor/autoload.php';
$API_KEY = require __DIR__ . '/key.php';

$api = new PYS\LolApi\Api($API_KEY);
$league = $api->league('EUW', 19196451);

foreach ($league->leagueList as $item) {
    echo $item->name . PHP_EOL;
}
