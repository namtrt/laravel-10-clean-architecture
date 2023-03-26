<?php

namespace Src\Application\DTOs\Auth;

class LoginCommand
{
    public function __construct(
        public string $email,
        public string $password
    ) {
    }
}
