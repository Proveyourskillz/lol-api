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
     * @var Region
     */
    protected $region;

    /**
     * AbstractRequest constructor.
     *
     * @param string|Region $region
     *
     * @throws \PYS\LolApi\Exceptions\WrongRegion
     */
    public function __construct($region)
    {
        $this->region = $region instanceof Region ? $region : new Region($region);
    }
}
