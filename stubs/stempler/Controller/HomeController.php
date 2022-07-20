<?php

declare(strict_types=1);

namespace App\Controller;

use Spiral\Prototype\Traits\PrototypeTrait;
use Spiral\Router\Annotation\Route;
use Spiral\Security\ActorInterface;

class HomeController
{
    use PrototypeTrait;

    #[Route(route: '/', name: 'home', methods: ['GET'])]
    public function index(ActorInterface $actor): string
    {
        return $this->views->render('home.dark.php', ['user' => $actor]);
    }
}
