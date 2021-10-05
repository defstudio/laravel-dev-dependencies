<?php


use Illuminate\Auth\Access\AuthorizationException;

function mock_authorization(string $action, mixed $target = null, $allow = true): void
{
    if ($allow) {
        Gate::shouldReceive('authorize')
            ->with($action, $target)
            ->andReturn(true)
            ->atLeast()->once();
    } else {
        Gate::shouldReceive('authorize')
            ->with($action, $target)
            ->andThrow(AuthorizationException::class)
            ->atLeast()->once();
    }
}

function bind_mock(string $class, callable ...$methods)
{
    $mock = mock($class)->expect(...$methods);
    app()->bind($class, fn () => $mock);
}
