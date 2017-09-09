<?php namespace PYS\LolApi\ApiRequest;

use PYS\LolApi\Api;
use PYS\LolApi\Mapper\MapperInterface;

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
        if (!$this->mapper) {
            $this->mapper = new $this->mapperClass;
        }

        return $this->mapper;
    }
}
