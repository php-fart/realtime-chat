<?php

declare(strict_types=1);

namespace App\Database;

use App\Repository\UserRepository;
use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Entity;

#[Entity(
    repository: UserRepository::class
)]
class User
{
    #[Column(type: 'primary')]
    public int $id;

    public function __construct(
        #[Column(type: 'string')]
        public string $username,

        #[Column(type: 'string')]
        public string $password,
    ) {
    }
}
