<?php namespace PYS\LolApi\ApiRequest;

use PYS\LolApi\Mapper\MapperInterface;

abstract class AbstractRequest implements ApiRequestInterface
{
    use GettersTrait;
    /*
     * Name of mapper class
     * @var string
     */
    protected static $mapperClass;
    /**
     * Data to object mapper class name
     * @var MapperInterface
     */
    protected $mapper;
    /**
     * Region of API platform
     * @var string
     */
    protected $region;
}
