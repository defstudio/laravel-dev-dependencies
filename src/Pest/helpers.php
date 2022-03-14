<?php


use Illuminate\Auth\Access\AuthorizationException;

function mock_gate_check(string $action, mixed $target = null, $allow = true): void
{
    if ($allow) {
        Gate::shouldReceive('check')
            ->with($action, $target)
            ->andReturn(true)
            ->atLeast()->once();
    } else {
        Gate::shouldReceive('check')
            ->with($action, $target)
            ->andThrow(AuthorizationException::class)
            ->atLeast()->once();
    }
}

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

/**
 * @template TClass
 * @param class-string<TClass> $class
 * @param callable ...$methods
 *
 * @return TClass|\Mockery\MockInterface
 */
function bind_mock(string $class, callable ...$methods): object
{
    $mock = mock($class)->expect(...$methods);
    app()->bind($class, fn () => $mock);

    return $mock;
}


/**
 * @param object $class
 *
 * @return object
 */
function bind_test_double(object $class): object
{
    app()->bind(get_parent_class($class), $class::class);

    return app(get_parent_class($class));
}
