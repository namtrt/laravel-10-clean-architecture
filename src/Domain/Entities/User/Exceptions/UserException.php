<?php

namespace Src\Domain\Entities\User\Exceptions;

use Src\Domain\Exceptions\AppException;

class UserException extends AppException
{
    protected static string $groupCode = '01';
}
