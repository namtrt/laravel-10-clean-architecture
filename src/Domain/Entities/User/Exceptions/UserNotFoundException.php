<?php

namespace Src\Domain\Entities\User\Exceptions;

class UserNotFoundException extends UserException
{
    /** @var string */
    protected static string $errorCode = '01';

    /** @var int */
    protected static int $statusCode = 404;

    public static function create(int $id): self
    {
        return new self(
            message: sprintf("User {%d} not found", $id),
            code: self::$statusCode
        );
    }
}
