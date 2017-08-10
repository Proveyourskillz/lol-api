<?php namespace Likewinter\LolApi\ApiRequest;

use DusanKasan\Knapsack\Collection;

trait QueryParamsTrait
{
    /**
     * Array with additional query parameters for API call
     * @var array
     */
    protected $query = [];

    public function getQuery(): array
    {
        return $this->query ?? [];
    }

    public function setQuery(array $query): self
    {
        $this->query = $this->filterQuery($query);

        return $this;
    }

    public function filterQuery(array $query): array
    {
        return Collection::from($query)
            ->only(static::$queryParams)
            ->toArray();
    }
}
