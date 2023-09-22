<?php

declare(strict_types=1);

namespace App\Application\Bootloader;

use App\Application\Http\ExceptionHandlerInterceptor;
use Spiral\Bootloader\DomainBootloader;
use Spiral\Core\CoreInterface;
use Spiral\Cycle\Interceptor\CycleInterceptor;
use Spiral\Domain\GuardInterceptor;

/**
 * @link https://spiral.dev/docs/http-interceptors
 */
final class AppBootloader extends DomainBootloader
{
    protected const SINGLETONS = [CoreInterface::class => [self::class, 'domainCore']];

    protected const INTERCEPTORS = [
        CycleInterceptor::class,
        ExceptionHandlerInterceptor::class,
//        GuardInterceptor::class,
    ];
}
