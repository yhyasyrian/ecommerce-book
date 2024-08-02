<?php

namespace App\Exceptions;

class NoCreateException extends \Exception implements \Throwable
{
    public function __construct(string $message = 'no operation',int $code = 0,?\Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
