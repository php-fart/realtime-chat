<?php

declare(strict_types=1);

namespace App\Database;

use App\Repository\ThreadRepository;
use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Entity;

#[Entity(repository: ThreadRepository::class)]
class Thread
{
    #[Column(type: 'primary')]
    public int $id;

    public function __construct(
        #[Column(type: 'string')]
        public string $name,
    ) {
    }
}
