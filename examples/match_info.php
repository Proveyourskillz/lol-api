<?php
require __DIR__ . './../vendor/autoload.php';
$API_KEY = require __DIR__ . '/key.php';

$api = new PYS\LolApi\Api($API_KEY);

$match = $api->match('EUW', 3329302609);

echo 'List of summoners:' . PHP_EOL;
foreach ($match->participantIdentities as $identity) {
    echo $identity->participantId . ' ' . $identity->player->summonerName . PHP_EOL;
}
