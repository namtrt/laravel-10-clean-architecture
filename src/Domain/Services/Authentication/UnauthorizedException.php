<?php

namespace Src\Domain\Services\Authentication;

class UnauthorizedException extends AuthException
{
    /** @var string */
    protected static string $errorCode = '01';

    /** @var int */
    protected static int $statusCode = 401;

    public static function create(): self
    {
        return new self(message: "Email or password was incorrect!", code: self::$statusCode);
    }
}
