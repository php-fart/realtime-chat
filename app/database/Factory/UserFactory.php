<?php

declare(strict_types=1);

namespace Database\Factory;

use App\Database\User;
use Spiral\DatabaseSeeder\Factory\AbstractFactory;

final class UserFactory extends AbstractFactory
{
    public function entity(): string
    {
        return User::class;
    }

    public function definition(): array
    {
        return [
            'username' => $this->faker->userName(),
            'password' => \password_hash('secret', \PASSWORD_BCRYPT),
        ];
    }

    public function makeEntity(array $definition): object
    {
        return new User(
            $definition['username'],
            $definition['password'],
        );
    }

    public function withUsername(string $username): self
    {
        return $this->entityState(function (User $user) use ($username) {
            $user->username = $username;

            return $user;
        });
    }
}
