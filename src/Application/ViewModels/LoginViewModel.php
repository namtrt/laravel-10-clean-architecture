<?php

namespace Src\Application\ViewModels;

class LoginViewModel
{
    public function __construct(
        public string $token,
        public int $expired_at,
    ) {
    }
}
