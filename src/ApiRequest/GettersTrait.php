<?php namespace Likewinter\LolApi\ApiRequest;

use Likewinter\LolApi\Api;
use Likewinter\LolApi\Mapper\MapperInterface;

trait GettersTrait
{
    public function getType(): string
    {
        return $this->type;
    }

    public function getSubtypes(): array
    {
        return $this->subtypes;
    }

    public function getVersion(): ?int
    {
        return $this->version;
    }

    public function getQuery(): ?array
    {
        return $this->query;
    }

    public function getPlatform(): ?string
    {
        return Api::REGIONS_PLATFORMS[$this->region] ?? null;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function getMapper(): MapperInterface
    {
        return $this->mapper;
    }
}
