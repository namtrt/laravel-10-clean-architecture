<?php

namespace Src\Domain\Entities\User;

interface UserRepository
{
    public function findById(int $id): User;

    public function checkByEmail(string $email): bool;

    public function create(string $name, string $email, string $password): User;
}
