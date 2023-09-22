<?php

declare(strict_types=1);

namespace App\Database;

use App\Repository\MessageRepository;
use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Entity;
use Cycle\Annotated\Annotation\Relation\BelongsTo;

#[Entity(
    repository: MessageRepository::class
)]
class Message
{
    #[Column(type: 'primary')]
    public int $id;

    public function __construct(
        #[Column(type: 'string')]
        public string $message,

        #[BelongsTo(target: User::class)]
        public User $user,

        #[BelongsTo(target: Thread::class)]
        public Thread $thread,
    ) {
    }
}
