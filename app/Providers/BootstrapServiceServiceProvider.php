<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Domain\Services\Authentication\AuthenticationService;
use Src\Infrastructure\Application\Services\AuthenticationServiceImpl;

class BootstrapServiceServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(AuthenticationService::class, AuthenticationServiceImpl::class);
    }
}
