<?php namespace Likewinter\LolApi\ApiRequest;

interface ApiQueryRequestInterface
{
    public function getQuery(): array;
    public function setQuery(array $query);
    public function filterQuery(array $query): array;
}