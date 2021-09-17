<?php

namespace DefStudio\LaravelDevDependencies;

class FakeQueryWatcherClass extends \Spatie\LaravelRay\Watchers\QueryWatcher
{
    public function register(): void
    {
        //    Disable Ray → QueryWatcher during tests
    }
}
