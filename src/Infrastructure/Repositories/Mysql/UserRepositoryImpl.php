<?php

namespace Src\Infrastructure\Repositories\Mysql;

use Carbon\Carbon;
use Src\Domain\Entities\User\Exceptions\UserNotFoundException;
use Src\Domain\Entities\User\User;
use Src\Domain\Entities\User\UserRepository;

class UserRepositoryImpl implements UserRepository
{
    /**
     * @throws UserNotFoundException
     */
    public function findById(int $id): User
    {
        /** @var \App\Models\User $user */
        $user = \App\Models\User::query()->find($id);

        if (!$user) {
            throw UserNotFoundException::create($id);
        }

        return new User(
            id: $user->id,
            name: $user->name,
            email: $user->email,
            verifiedAt: Carbon::parse($user->email_verified_at)->format('Y-m-d H:i:s'),
            createdAt: Carbon::parse($user->created_at)->format('Y-m-d H:i:s')
        );
    }
}
