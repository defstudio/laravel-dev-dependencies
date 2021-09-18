<?php

function bind_mock(string $class, callable ...$methods)
{
    $mock = mock($class)->expect(...$methods);
    app()->bind($class, fn () => $mock);
}
