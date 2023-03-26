<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Domain\Entities\User\UserRepository;
use Src\Infrastructure\Repositories\Mysql\UserRepositoryImpl;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(UserRepository::class, UserRepositoryImpl::class);
    }
}
