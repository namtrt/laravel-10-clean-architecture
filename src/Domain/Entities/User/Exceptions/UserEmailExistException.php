<?php

namespace Src\Domain\Entities\User\Exceptions;

class UserEmailExistException extends UserException
{
    /** @var string */
    protected static string $errorCode = '02';

    public static function create(): self
    {
        return new self(
            message: "Email already exists",
            code: self::$statusCode
        );
    }
}
