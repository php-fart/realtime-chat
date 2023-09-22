<?php

declare(strict_types=1);

namespace App\Application\Http;

use Spiral\Prototype\Annotation\Prototyped;
use Spiral\Prototype\Traits\PrototypeTrait;
use Spiral\Session\SessionSectionInterface;

#[Prototyped('sessionErrors')]
final class SessionErrors
{
    use PrototypeTrait;

    public function session(): SessionSectionInterface
    {
        return $this->session->getSection('errors');
    }

    public function clear(): void
    {
        $this->session()->clear();
    }

    public function add(string $key, string $message): void
    {
        $this->session()->set($key, $message);
    }

    public function all(): array
    {
        $errors = $this->session()->getAll();

        $this->clear();

        return $errors;
    }
}
