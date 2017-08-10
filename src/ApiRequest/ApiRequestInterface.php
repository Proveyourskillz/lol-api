<?php namespace Likewinter\LolApi\ApiRequest;

use Likewinter\LolApi\Mapper\MapperInterface;

interface ApiRequestInterface
{
    public function getType(): string;
    public function getSubtypes(): array;
    public function getRegion(): ?string;
    public function getPlatform(): ?string;
    public function getVersion(): ?int;
    public function getMapper(): MapperInterface;
}
