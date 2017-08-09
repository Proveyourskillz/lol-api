<?php namespace Likewinter\LolApi\Models;

use Likewinter\LolApi\Api;

interface ModelInterface
{
    public function getApi(): Api;
    public function wireApi(Api $api): ModelInterface;
}
