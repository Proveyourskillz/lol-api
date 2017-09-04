<?php
require __DIR__ . './../vendor/autoload.php';

const API_KEY = 'API_KEY_HERE';

use Likewinter\LolApi\ApiRequest\MatchRequest;

$api = new Likewinter\LolApi\Api(API_KEY);

$match = $api->makeMatch(MatchRequest::byMatchId('EUW', 3329302609));

print_r($match);


