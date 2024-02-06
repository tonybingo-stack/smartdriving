<?php

namespace App\Exceptions;

use App\Enums\ExceptionCode;
use Exception;

class NetopiaException extends Exception
{
    /**
     * Create a new NetopiaException instance from a given exception code.
     *
     * @param ExceptionCode $exceptionCode
     * @return static
     */
    public static function fromCode(ExceptionCode $exceptionCode): self
    {
        return new self(code: $exceptionCode->value);
    }
}
