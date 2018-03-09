<?php
require __DIR__ . './../vendor/autoload.php';

use PYS\LolApi\ApiRequest\Region;

$api = new PYS\LolApi\Api(function () {
    return require __DIR__ . '/key.php';
});

while (true) {
    $match = $api->match(Region::EUW, 3329302609);

    echo 'List of summoners:' . PHP_EOL;
    foreach ($match->participantIdentities as $identity) {
        echo $identity->participantId . ' ' . $identity->player->summonerName . PHP_EOL;
    }
    sleep(2);
}
