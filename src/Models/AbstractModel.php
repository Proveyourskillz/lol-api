<?php namespace Likewinter\LolApi\Models;

use Likewinter\LolApi\Api;

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
            throw new \Exception('Model was not instantiated by API Request');
        }
    }
}
