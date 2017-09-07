<?php
require __DIR__ . './../vendor/autoload.php';
$API_KEY = require __DIR__ . '/key.php';

use Likewinter\LolApi\ApiRequest\MatchRequest;

$api = new Likewinter\LolApi\Api($API_KEY);

$match = $api->makeMatch(new MatchRequest('EUW', 3329302609));

echo 'List of summoners:' . PHP_EOL;
foreach ($match->participantIdentities as $identity) {
    echo $identity->participantId . ' ' . $identity->player->summonerName . PHP_EOL;
}
