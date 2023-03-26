<?php

namespace Src\Application\UseCases\Auth;

use Src\Application\DTOs\Auth\LoginCommand;
use Src\Application\ViewModels\LoginViewModel;
use Src\Domain\Services\Authentication\AuthenticationService;
use Src\Domain\Services\Authentication\UnauthorizedException;

class LoginHandler
{
    public function __construct(
        private readonly AuthenticationService $authenticationService
    ) {
    }

    /**
     * @throws UnauthorizedException
     */
    public function handle(LoginCommand $command): LoginViewModel
    {
        $token = $this->authenticationService->getAuthenticateToken($command->email, $command->password);
        $expiredAt = $this->authenticationService->getTokenExpirationTime();

        return new LoginViewModel($token, $expiredAt);
    }
}
