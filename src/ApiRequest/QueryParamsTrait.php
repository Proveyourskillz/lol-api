<?php namespace Likewinter\LolApi\ApiRequest;

use DusanKasan\Knapsack\Collection;

trait QueryParamsTrait
{
    protected function setQuery(array $query): void
    {
        $this->query = Collection::from($query)
            ->only(static::$queryParams)
            ->toArray();
    }
}
