<?php

declare(strict_types=1);

namespace App\Endpoint\Centrifugo\Handler;

use App\Database\Message;
use App\Database\User;
use Cycle\ORM\EntityManagerInterface;
use RoadRunner\Centrifugo\Payload\ConnectResponse;
use RoadRunner\Centrifugo\Payload\RPCResponse;
use RoadRunner\Centrifugo\Request\RequestInterface;
use RoadRunner\Centrifugo\Request\RPC;
use Spiral\Auth\ActorProviderInterface;
use Spiral\Core\InvokerInterface;
use Spiral\Prototype\Traits\PrototypeTrait;
use Spiral\RoadRunnerBridge\Centrifugo\ServiceInterface;

final class RPCHandler implements ServiceInterface
{
    use PrototypeTrait;

    public function __construct(
        private readonly ActorProviderInterface $actorProvider,
        private readonly InvokerInterface $invoker,
        private readonly EntityManagerInterface $em,
    ) {
    }

    /**
     * @param RPC $request
     */
    public function handle(RequestInterface $request): void
    {
        dump($request);
        try {
            // handle RPC request
            $authToken = $request->getData()['authToken'];
            $user = null;
            if ($authToken) {
                $user = $this->getActor($authToken);
            }

            if (!$user) {
                $request->error(403, 'Unauthorized');
                return;
            }

            $result = match ($request->method) {
                'thread:history' => $this->invoker->invoke(
                    [$this, 'threadHistory'],
                    $request->getData(),
                ),
                'thread:publish' => $this->invoker->invoke(
                    [$this, 'threadPublish'],
                    \array_merge($request->getData(), ['user' => $user])
                )
            };

            dump($result);

            $request->respond(
                new RPCResponse(
                    data: $result,
                ),
            );
        } catch (\Throwable $e) {
            $request->error($e->getCode(), $e->getMessage());
        }
    }

    public function threadHistory(int $id): array
    {
        return [
            'messages' => \array_map(
                fn(Message $message) => [
                    'id' => $message->id,
                    'username' => $message->user->username,
                    'message' => $message->message,
                ],
                $this->messages->findAll([
                    'thread_id' => $id
                ])
            )
        ];
    }

    public function threadPublish(int $id, string $message, User $user): array
    {
        $thread = $this->threads->findByPK($id);

        $message = new Message(
            message: $message,
            user: $user,
            thread: $thread,
        );

        $this->em->persist($message)->run();

        $this->broadcast->publish(
            'chat', \json_encode([
                'type' => 'message',
                'message' => $message->message,
                'thread' => ['id' => $thread->id],
                'username' => $message->user->username,
            ])
        );

        return [
            'message' => $message->message,
            'thread' => ['id' => $thread->id],
            'username' => $message->user->username,
        ];
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
