<?php

namespace App\Controller\Auth;

use App\Database\User;
use App\Filter\Auth\RegisterRequest;
use Cycle\ORM\EntityManagerInterface;
use Spiral\Prototype\Traits\PrototypeTrait;
use Spiral\Router\Annotation\Route;
use Spiral\Views\ViewsInterface;

class RegisterController
{
    use PrototypeTrait;

    #[Route(route: 'register', name: 'register:form', methods: ['GET'])]
    public function index(ViewsInterface $view)
    {
        return $view->render('auth/register');
    }

    #[Route(route: '/register', name: 'register', methods: ['POST'])]
    public function register(RegisterRequest $request, EntityManagerInterface $entityManager)
    {
        if (!$request->isValid()) {
            return [
                'status' => 400,
                'errors' => $request->getErrors()
            ];
        }

        $user = new User();
        $user->setEmail($request->email);
        $user->setPassword(password_hash($request->password, PASSWORD_BCRYPT));

        $entityManager->persist($user);
        $entityManager->run();

        return [
            'status' => 200,
            'message' => 'Registered!',
        ];
    }
}
