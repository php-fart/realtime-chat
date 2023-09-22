<?php

declare(strict_types=1);

namespace App\Application\Http;

use Spiral\Auth\ActorProviderInterface;
use Spiral\Auth\TokenInterface;
use Spiral\Prototype\Traits\PrototypeTrait;

final class UserProvider implements ActorProviderInterface
{
    use PrototypeTrait;

    public function getActor(TokenInterface $token): ?object
    {
        if(!isset($token->getPayload()['username'])) {
            return null;
        }


        return $this->users->findByUsername($token->getPayload()['username']);
    }
}
