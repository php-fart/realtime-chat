<?php

declare(strict_types=1);

namespace App\Application\Bootloader;

use Spiral\Boot\Bootloader\Bootloader;

final class AuthBootloader extends Bootloader
{
    public function init(\Spiral\Bootloader\Auth\AuthBootloader $authBootloader): void
    {
        $authBootloader->addActorProvider(\App\Application\Http\UserProvider::class);
    }
}
