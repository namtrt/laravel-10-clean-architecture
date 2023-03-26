<?php

namespace Src\Domain\Exceptions;

use Exception;

abstract class AppException extends Exception
{
    /** @var string */
    protected static string $serviceCode = '01';

    /** @var string */
    protected static string $groupCode = '__';

    /** @var string */
    protected static string $errorCode = '__';

    /** @var int */
    protected static int $statusCode = 400;

    public function getErrorCode(): string
    {
        return static::$serviceCode . static::$groupCode . static::$errorCode;
    }
}

