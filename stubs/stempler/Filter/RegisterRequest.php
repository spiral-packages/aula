<?php

declare(strict_types=1);

namespace App\Filter\Auth;

use Spiral\Filters\Attribute\Input\Post;
use Spiral\Filters\Filter;
use Spiral\Filters\FilterDefinitionInterface;
use Spiral\Filters\HasFilterDefinition;
use Spiral\Validation\Laravel\FilterDefinition;

class RegisterRequest extends Filter implements HasFilterDefinition
{
    #[Post]
    public string $email;

    #[Post]
    public string $password;

    public function filterDefinition(): FilterDefinitionInterface
    {
        return new FilterDefinition([
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed'],
        ], [
            'password_confirmation' => 'data:password_confirmation',
        ]);
    }
}
