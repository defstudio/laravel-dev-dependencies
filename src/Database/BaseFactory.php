<?php

namespace DefStudio\LaravelDevDependencies\Database;

use Illuminate\Database\Eloquent\Factories\Factory;

abstract class BaseFactory extends Factory
{
    public function with_fake_id(): self
    {
        return $this->state(fn (array $attributes) => [
            'id' => $this->faker->randomDigitNotNull,
        ]);
    }
}
