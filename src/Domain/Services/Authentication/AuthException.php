<?php

namespace Src\Domain\Services\Authentication;

use Src\Domain\Exceptions\AppException;

class AuthException extends AppException
{
    protected static string $groupCode = '01';
}
