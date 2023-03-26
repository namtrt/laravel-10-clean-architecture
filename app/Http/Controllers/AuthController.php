<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthLoginRequest;
use League\Tactician\CommandBus;
use Src\Application\DTOs\Auth\LoginCommand;
use Src\Application\DTOs\Auth\ProfileCommand;
use Src\Infrastructure\Application\Responses\SuccessResponse;

class AuthController extends Controller
{
    public function __construct(
        private readonly CommandBus $commandBus
    ) {
    }

    public function login(AuthLoginRequest $request): SuccessResponse
    {
        $command = new LoginCommand(
            email: $request->input('email'),
            password: $request->input('password')
        );

        $data = $this->commandBus->handle($command);

        return SuccessResponse::make($data);
    }

    public function profile(): SuccessResponse
    {
        $userId = auth('api')->id();
        $command = new ProfileCommand($userId);

        return SuccessResponse::make($this->commandBus->handle($command));
    }
}
