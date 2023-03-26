<?php

namespace Src\Application\DTOs\Auth;

use Src\Application\Contracts\Transactional;

class RegisterCommand implements Transactional
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password
    ) {
    }
}
