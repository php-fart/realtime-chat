<?php

declare(strict_types=1);

namespace App\Endpoint\Centrifugo\Handler;

use App\Database\User;
use RoadRunner\Centrifugo\Payload\ConnectResponse;
use RoadRunner\Centrifugo\Request\Connect;
use RoadRunner\Centrifugo\Request\RequestInterface;
use Spiral\Auth\ActorProviderInterface;
use Spiral\Prototype\Traits\PrototypeTrait;
use Spiral\RoadRunnerBridge\Centrifugo\ServiceInterface;

final class ConnectHandler implements ServiceInterface
{
    use PrototypeTrait;

    public function __construct(
        private readonly ActorProviderInterface $actorProvider,
    ) {
    }

    /**
     * @param Connect $request
     */
    public function handle(RequestInterface $request): void
    {
        try {
            // handle connect request
            $authToken = $request->getData()['authToken'];
            $user = null;
            if ($authToken) {
                $user = $this->getActor($authToken);
            }

            if (!$user) {
                $request->error(403, 'Unauthorized');
                return;
            }

            $request->respond(
                new ConnectResponse(
                    user: '1',
                    data: ['username' => $user->username, 'id' => $user->id],
                    channels: ['chat'],
                ),
            );
        } catch (\Throwable $e) {
            $request->error($e->getCode(), $e->getMessage());
        }
    }

    public function getActor(string $token): ?User
    {
        $token = $this->authTokens->load($token);
        if (!$token) {
            return null;
        }

        return $this->actorProvider->getActor($token);
    }
}
