<?php

namespace Src\Domain\Services\Authentication;

interface AuthenticationService
{
    /**
     * @param string $email
     * @param string $password
     *
     * @return string
     * @throws UnauthorizedException
     */
    public function getAuthenticateToken(string $email, string $password): string;

    /**
     * @return int
     */
    public function getTokenExpirationTime(): int;
}
