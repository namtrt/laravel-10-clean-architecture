<?php

namespace Src\Domain\Entities\User\Exceptions;

class UserTestTransactionException extends UserException
{
    /** @var string */
    protected static string $errorCode = '99';

    public static function create(): self
    {
        return new self(
            message: "The user just created has been rolled back",
            code: self::$statusCode
        );
    }
}
