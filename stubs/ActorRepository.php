<?php

namespace App\Repositories\Auth;

use Spiral\Auth\ActorProviderInterface;
use Spiral\Auth\TokenInterface;

class ActorRepository implements ActorProviderInterface
{
    public function getActor(TokenInterface $token): ?object
    {
        //
    }
}
