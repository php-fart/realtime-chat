<?php

declare(strict_types=1);

namespace App\Endpoint\Web;

use App\Application\Exception\InvalidCredentialsException;
use App\Endpoint\Web\Filter\LoginFilter;
use Psr\Http\Message\ResponseInterface;
use Spiral\Csrf\Middleware\CsrfMiddleware;
use Spiral\Domain\Annotation\Guarded;
use Spiral\Prototype\Traits\PrototypeTrait;
use Spiral\Router\Annotation\Route;

class LoginController
{
    use PrototypeTrait;

    #[Route(route: 'login', methods: ['GET'])]
    public function loginForm(): ResponseInterface
    {
        return $this->response->html(
            $this->views->render('login', [
                'csrf' => $this->request->attribute(CsrfMiddleware::ATTRIBUTE),
                'errors' => $this->sessionErrors->all(),
            ]),
        );
    }

    #[Route(route: 'login', methods: ['POST'])]
    public function login(LoginFilter $filter): ResponseInterface
    {
        $user = $this->users->findByUsername($filter->username);

        if (!$user) {
            throw new InvalidCredentialsException('Invalid username or password');
        }

        $token = $this->authTokens->create(['username' => $user->username, 'id' => $user->id]);
        $this->auth->start($token);

        return $this->response->redirect('/');
    }
}
