<?php

namespace Src\Domain\Entities\User;

interface UserRepository
{
    public function findById(int $id): User;
}
