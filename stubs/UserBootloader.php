<?php

namespace App\Bootloader;

use Spiral\Boot\Bootloader\Bootloader;
use Spiral\Bootloader\Auth\AuthBootloader;
use App\Repositories\Auth\ActorRepository;

class UserBootloader extends Bootloader
{
    public function boot(AuthBootloader $auth)
    {
        $auth->addActorProvider(ActorRepository::class);
    }
}
