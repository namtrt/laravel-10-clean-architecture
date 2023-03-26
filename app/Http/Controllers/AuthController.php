<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\AuthRegisterRequest;
use League\Tactician\CommandBus;
use Src\Application\DTOs\Auth\LoginCommand;
use Src\Application\DTOs\Auth\ProfileCommand;
use Src\Application\DTOs\Auth\RegisterCommand;
use Src\Infrastructure\Application\Responses\SuccessResponse;

class AuthController extends Controller
{
    /**
     * @param CommandBus $commandBus
     */
    public function __construct(
        private readonly CommandBus $commandBus
    ) {
    }

    /**
     * @param AuthLoginRequest $request
     * @return SuccessResponse
     */
    public function login(AuthLoginRequest $request): SuccessResponse
    {
        $command = new LoginCommand(
            email: $request->input('email'),
            password: $request->input('password')
        );

        $data = $this->commandBus->handle($command);

        return SuccessResponse::make($data);
    }

    /**
     * @return SuccessResponse
     */
    public function profile(): SuccessResponse
    {
        $userId = auth('api')->id();
        $command = new ProfileCommand($userId);

        return SuccessResponse::make($this->commandBus->handle($command));
    }

    /**
     * @param AuthRegisterRequest $request
     * @return SuccessResponse
     */
    public function register(AuthRegisterRequest $request): SuccessResponse
    {
        $command = new RegisterCommand(
            name: $request->input('name'),
            email: $request->input('email'),
            password: $request->input('password')
        );

        return SuccessResponse::make($this->commandBus->handle($command));
    }
}
