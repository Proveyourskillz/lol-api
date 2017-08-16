<?php namespace Likewinter\LolApi\Exceptions;

class WrongRequestException extends \Exception
{
    public function setMethodAndRequest(string $method, string $class)
    {
        $this->message = "$method API method can process only $class";
    }
}
