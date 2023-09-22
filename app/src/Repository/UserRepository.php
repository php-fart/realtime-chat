<?php

declare(strict_types=1);

namespace App\Repository;

use App\Database\User;
use Cycle\ORM\Select\Repository;
use Spiral\Prototype\Annotation\Prototyped;

#[Prototyped('users')]
class UserRepository extends Repository
{
    public function findByUsername(string $username): ?User
    {
        return $this->findOne([
            'username' => $username,
        ]);
    }
}
