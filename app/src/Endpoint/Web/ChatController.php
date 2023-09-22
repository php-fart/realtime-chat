<?php

declare(strict_types=1);

namespace App\Endpoint\Web;

use Psr\Http\Message\ResponseInterface;
use Spiral\Prototype\Traits\PrototypeTrait;
use Spiral\Router\Annotation\Route;

class ChatController
{
    use PrototypeTrait;

    #[Route(route: '/', group: 'auth')]
    public function index(): ResponseInterface
    {
        return $this->response->html(
            $this->views->render('chat', [
                'token' => $this->auth->getToken()->getID(),
            ]),
        );
    }
}
