<?php

namespace Src\Application\UseCases\Auth;

use Src\Application\DTOs\Auth\RegisterCommand;
use Src\Application\ViewModels\ProfileViewModel;
use Src\Domain\Entities\User\Exceptions\UserEmailExistException;
use Src\Domain\Entities\User\Exceptions\UserTestTransactionException;
use Src\Domain\Entities\User\UserRepository;

class RegisterHandler
{
    public function __construct(
        private readonly UserRepository $userRepository
    ) {
    }

    /**
     * @throws UserTestTransactionException
     * @throws UserEmailExistException
     */
    public function handle(RegisterCommand $command): ProfileViewModel
    {
        if ($this->userRepository->checkByEmail($command->email)) {
            throw UserEmailExistException::create();
        }

        $user = $this->userRepository->create(
            name: $command->name,
            email: $command->email,
            password: $command->password
        );

        /** Test rollback transaction */
        if ($user->getEmail() === 'error@admin.com') {
            throw UserTestTransactionException::create();
        }

        return new ProfileViewModel(
            id: $user->getId(),
            name: $user->getName(),
            email: $user->getEmail(),
            verified_at: $user->getVerifiedAt(),
            created_at: $user->getCreatedAt()
        );
    }
}
