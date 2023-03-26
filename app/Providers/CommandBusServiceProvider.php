<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use League\Tactician\CommandBus;
use League\Tactician\Handler\CommandHandlerMiddleware;
use League\Tactician\Handler\CommandNameExtractor\ClassNameExtractor;
use League\Tactician\Handler\Locator\InMemoryLocator;
use League\Tactician\Handler\MethodNameInflector\HandleInflector;
use Src\Infrastructure\Application\Middlewares\TransactionMiddleware;

class CommandBusServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(CommandBus::class, static function () : CommandBus {
            $middlewares = [];
            $middlewares[] = app()->get(TransactionMiddleware::class);
            $middlewares[] = app()->get(CommandHandlerMiddleware::class);
            return new CommandBus($middlewares);
        });

        $app = $this->app;
        $this->app->bind(CommandHandlerMiddleware::class, static function () use ($app): CommandHandlerMiddleware {
            return new CommandHandlerMiddleware(
                new ClassNameExtractor(),
                $app->get(InMemoryLocator::class),
                new HandleInflector()
            );
        });
    }
}
