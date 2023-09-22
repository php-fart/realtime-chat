<?php

declare(strict_types=1);

use App\Endpoint\Centrifugo\Handler\ConnectHandler;
use App\Endpoint\Centrifugo\Handler\RPCHandler;
use RoadRunner\Centrifugo\Request\RequestType;

return [
    'services' => [
        RequestType::Connect->value => ConnectHandler::class,
        RequestType::RPC->value => RPCHandler::class,
    ],
];
