<?php
require __DIR__ . './../vendor/autoload.php';
$API_KEY = require __DIR__ . '/key.php';

$api = new PYS\LolApi\Api($API_KEY);

$summoner = $api->summoner('EUW', 19196451);
$leagues = $summoner->leaguesPositions();

$another_league = $api->leaguePosition('EUW', 19196451);

print_r($leagues->leaguesPlayed);
print_r($another_league->leaguesPlayed);




