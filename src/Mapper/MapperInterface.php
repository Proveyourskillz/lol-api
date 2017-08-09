<?php namespace Likewinter\LolApi\Mapper;

use Likewinter\LolApi\Models\ModelInterface;

interface MapperInterface
{
    public function map($data): ModelInterface;
}
