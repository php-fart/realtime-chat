<?php

declare(strict_types=1);

namespace Database\Factory;

use App\Database\Thread;
use Spiral\DatabaseSeeder\Factory\AbstractFactory;

class ThreadFactory extends AbstractFactory
{
    /**
     * Returns a fully qualified database entity class name
     */
    public function entity(): string
    {
        return Thread::class;
    }

    /**
     * Returns array with generation rules
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(),
        ];
    }

    public function makeEntity(array $definition): object
    {
        return new Thread(
            $definition['name'],
        );
    }

    public function withName(string $name): self
    {
        return $this->entityState(function (Thread $thread) use ($name) {
            $thread->name = $name;

            return $thread;
        });
    }
}
