<?php

declare(strict_types=1);

namespace App\Application\Http;

use App\Application\Exception\InvalidCredentialsException;
use Spiral\Core\CoreInterceptorInterface;
use Spiral\Core\CoreInterface;
use Spiral\Prototype\Traits\PrototypeTrait;

final class ExceptionHandlerInterceptor implements CoreInterceptorInterface
{
    use PrototypeTrait;

    public function process(string $controller, string $action, array $parameters, CoreInterface $core): mixed
    {
        try {
            return $core->callAction($controller, $action, $parameters);
        } catch (InvalidCredentialsException $e) {
            $this->sessionErrors->add('username', $e->getMessage());

            return $this->response->redirect('/login');
        }
    }
}
