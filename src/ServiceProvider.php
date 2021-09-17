<?php

namespace DefStudio\LaravelDevDependencies;

use Spatie\LaravelRay\Watchers\QueryWatcher;


class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register()
    {
        if (!app()->environment('testing')) {
            return;
        }

        $this->app->bind(QueryWatcher::class, FakeQueryWatcherClass::class);
    }
}
