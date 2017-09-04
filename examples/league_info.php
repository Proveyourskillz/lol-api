<?php
/**
 * Created by PhpStorm.
 * User: pilot
 * Date: 9/4/17
 * Time: 10:24 PM
 */

require __DIR__ . './../vendor/autoload.php';

const API_KEY = 'API_KEY_HERE';
use Likewinter\LolApi\ApiRequest\LeagueRequest;
$api = new Likewinter\LolApi\Api(API_KEY);
$league = $api->makeLeague(LeagueRequest::bySummonerId('EUW', 19196451));

print_r($league);
