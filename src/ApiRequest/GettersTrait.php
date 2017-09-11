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

    public function getRegion(): Region
    {
        return $this->region;
    }

    public function getMapper(): MapperInterface
    {
        return new static::$mapperClass;
    }
}
