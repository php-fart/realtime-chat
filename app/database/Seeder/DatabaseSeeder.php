<?php

declare(strict_types=1);

namespace Database\Seeder;

use Database\Factory\ThreadFactory;
use Database\Factory\UserFactory;
use Spiral\DatabaseSeeder\Attribute\Seeder;
use Spiral\DatabaseSeeder\Seeder\AbstractSeeder;

#[Seeder]
class DatabaseSeeder extends AbstractSeeder
{
    public function run(): \Generator
    {
        yield UserFactory::new()->withUsername('john')->makeOne();
        yield UserFactory::new()->withUsername('bob')->makeOne();
        yield ThreadFactory::new()->withName('Super thread')->makeOne();
    }
}
