<?php

namespace Src\Application\DTOs\Auth;

class ProfileCommand
{
    public function __construct(
        public int $userId
    ) {
    }
}
