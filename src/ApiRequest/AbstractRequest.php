<?php namespace Likewinter\LolApi\ApiRequest;

use Likewinter\LolApi\Mapper\MapperInterface;

abstract class AbstractRequest implements ApiRequestInterface
{
    use GettersTrait;
    /**
     * Array with additional query parameters for API call
     * @var array
     */
    protected $query;
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
