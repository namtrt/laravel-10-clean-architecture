<?php

namespace Src\Infrastructure\Application\Services;

use Carbon\Carbon;
use Src\Domain\Services\Authentication\AuthenticationService;
use Src\Domain\Services\Authentication\UnauthorizedException;

class AuthenticationServiceImpl implements AuthenticationService
{
    /**
     * @throws UnauthorizedException
     */
    public function getAuthenticateToken(string $email, string $password): string
    {
        $token = auth('api')->attempt([
            'email' => $email,
            'password' => $password,
        ]);
        if (! $token) {
            throw UnauthorizedException::create();
        }

        return $token;
    }

    public function getTokenExpirationTime(): int
    {
        return time() + config('jwt.ttl');
    }
}
