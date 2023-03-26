<?php

namespace Src\Application\ViewModels;

class ProfileViewModel
{
    public function __construct(
        public int $id,
        public string $name,
        public string $email,
        public string $verified_at,
        public string $created_at,
    ) {
    }
}
