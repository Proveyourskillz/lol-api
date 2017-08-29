<?php namespace Likewinter\LolApi\Models;

use Likewinter\LolApi\Api;
use Likewinter\LolApi\Exceptions\NonApiModel;

abstract class AbstractModel implements ModelInterface
{
    /**
     * Region of request
     * @var string
     */
    public $region;
    /**
     * @var Api
     */
    private $wiredApi;

    public function wireRegion(string $region): ModelInterface
    {
        $this->region = $region;

        return $this;
    }

    public function wireApi(Api $api): ModelInterface
    {
        $this->wiredApi = $api;

        return $this;
    }

    public function getApi(): Api
    {
        if ($this->wiredApi) {
            return $this->wiredApi;
        } else {
            throw new NonApiModel('Model was not instantiated by API Request');
        }
    }
}
