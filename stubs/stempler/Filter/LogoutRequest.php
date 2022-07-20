<?php

declare(strict_types=1);

namespace App\Filter\Auth;

use Spiral\Filters\Attribute\Input\Post;
use Spiral\Filters\Filter;
use Spiral\Filters\FilterDefinitionInterface;
use Spiral\Filters\HasFilterDefinition;
use Spiral\Validation\Laravel\FilterDefinition;

class LogoutRequest extends Filter implements HasFilterDefinition
{
    #[Post]
    public string $token;

    public function filterDefinition(): FilterDefinitionInterface
    {
        return new FilterDefinition([
            'email' => ['required', 'string'],
        ]);
    }
}
