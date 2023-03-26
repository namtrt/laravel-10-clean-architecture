<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use League\Tactician\Handler\Locator\InMemoryLocator;

class CommandHandlerServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(InMemoryLocator::class, static function () : InMemoryLocator {
            $locator = new InMemoryLocator();
            foreach (config('command_handler') as $command => $handler) {
                $locator->addHandler(app()->make($handler), $command);
            }
            return $locator;
        });
    }
}
