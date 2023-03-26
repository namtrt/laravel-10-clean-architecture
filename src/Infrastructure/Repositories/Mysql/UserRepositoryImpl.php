<?php

namespace Src\Infrastructure\Repositories\Mysql;

use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
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

    public function create(
        string $name,
        string $email,
        string $password
    ): User
    {
        /** @var \App\Models\User $user */
        $user = \App\Models\User::query()
            ->create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
                'email_verified_at' => Carbon::now()
            ]);

        return new User(
            id: $user->id,
            name: $user->name,
            email: $user->email,
            verifiedAt: Carbon::parse($user->email_verified_at)->format('Y-m-d H:i:s'),
            createdAt: Carbon::parse($user->created_at)->format('Y-m-d H:i:s')
        );
    }

    public function checkByEmail(string $email): bool
    {
        /** @var \App\Models\User $user */
        $user = \App\Models\User::query()
            ->select('id')
            ->where('email', $email)
            ->first();

        return (bool) $user;
    }
}
