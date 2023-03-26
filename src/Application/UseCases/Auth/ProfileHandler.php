<?php

namespace Src\Application\UseCases\Auth;

use Src\Application\DTOs\Auth\ProfileCommand;
use Src\Application\ViewModels\ProfileViewModel;
use Src\Domain\Entities\User\UserRepository;

class ProfileHandler
{
    public function __construct(
        private readonly UserRepository $userRepository
    ) {
    }

    public function handle(ProfileCommand $command): ProfileViewModel
    {
        $user = $this->userRepository->findById($command->userId);

        return new ProfileViewModel(
            id: $user->getId(),
            name: $user->getName(),
            email: $user->getEmail(),
            verified_at: $user->getVerifiedAt(),
            created_at: $user->getCreatedAt()
        );
    }
}
