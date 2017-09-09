<?php namespace PYS\LolApi\Models;

use PYS\LolApi\Api;

interface ModelInterface
{
    public function getApi(): Api;
    public function wireApi(Api $api): self;
    public function wireRegion(string $region): self;
}
