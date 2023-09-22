<?php

declare(strict_types=1);

namespace App\Endpoint\Web\Filter;

use Spiral\Filters\Attribute\Input\Post;
use Spiral\Filters\Attribute\Setter;
use Spiral\Filters\Model\Filter;
use Spiral\Filters\Model\FilterDefinitionInterface;
use Spiral\Filters\Model\HasFilterDefinition;
use Spiral\Validator\FilterDefinition;

final class LoginFilter extends Filter implements HasFilterDefinition
{
    #[Post]
    #[Setter('trim')]
    public string $username;

    #[Post]
    #[Setter('trim')]
    public string $password;

    public function filterDefinition(): FilterDefinitionInterface
    {
        return new FilterDefinition(
            validationRules: [
                'username' => ['notEmpty', 'string'],
                'password' => ['notEmpty', 'string'],
            ],
        );
    }
}
