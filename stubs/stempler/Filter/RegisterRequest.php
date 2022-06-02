<?php

declare(strict_types=1);

namespace App\Filter\Auth;

use App\Database\User;
use Spiral\Filters\Filter;

class RegisterRequest extends Filter
{
    protected const SCHEMA = [
        'email' => 'data:email',
        'password' => 'data:password',
        'confirmPassword' => 'data:confirmPassword',
    ];

    protected const VALIDATES = [
        'email' => [
            ['notEmpty'],
            ['string'],
            ['email'],
            ['entity:unique', 'user', 'email', 'error' => 'Email address already used.'],
        ],
        'password' => ['notEmpty', 'string'],
        'confirmPassword' => [
            'string',
            ['notEmpty', 'if' => ['withAll' => ['password']]],
            ['match', 'password', 'error' => 'Passwords do not match.'],
        ],
    ];

    protected const SETTERS = [
        'email' => 'strval',
        'password' => 'strval',
        'confirmPassword' => 'strval',
    ];
}
