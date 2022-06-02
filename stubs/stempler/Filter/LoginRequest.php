<?php

declare(strict_types=1);

namespace App\Filter\Auth;

use Spiral\Filters\Filter;

class LoginRequest extends Filter
{
    protected const SCHEMA = [
        'email' => 'data:email',
        'password' => 'data:password',
    ];

    protected const VALIDATES = [
        'email' => ['notEmpty', 'string'],
        'password' => ['notEmpty', 'string'],
    ];

    protected const SETTERS = [
        'email' => 'strval',
        'password' => 'strval',
    ];

    private const DEFAULT_DURATION  = 'P1D';
    private const REMEMBER_DURATION = 'P1M';

    public function getSessionExpiration(): \DateTimeInterface
    {
        $now = new \DateTime();

        return $now->add(new \DateInterval(self::DEFAULT_DURATION));
    }
}
