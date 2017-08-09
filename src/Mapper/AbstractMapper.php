<?php namespace Likewinter\LolApi\Mapper;

use JsonMapper;
use Likewinter\LolApi\Models\ModelInterface;

abstract class AbstractMapper implements MapperInterface
{
    protected $mapper;
    protected $model;

    /**
     * AbstractMapper constructor.
     */
    public function __construct()
    {
        $this->mapper = new JsonMapper();
    }

    public function getModeInstance(): ModelInterface
    {
        return new $this->model();
    }

    public function map($data): ModelInterface
    {
        return $this->mapper->map($data, $this->getModeInstance());
    }
}
