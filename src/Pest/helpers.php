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

/**
 * @template TClass
 *
 * @param class-string<TClass> $model_class
 *
 * @return TClass
 */
function mock_model(string $model_class)
{
    $model_class = eval(<<<CLASS
        return new class() extends $model_class {
            public bool \$has_been_saved = false;
            public bool \$has_been_deleted = false;

            public function save(array \$options = []): bool
            {
                \$this->exists = true;
                \$this->has_been_saved = true;
                return true;
            }

            public function delete(): bool|null
            {
                \$this->exists = false;
                \$this->has_been_deleted = true;
                return true;
            }
        };
    CLASS);

    return bind_test_double($model_class);
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
