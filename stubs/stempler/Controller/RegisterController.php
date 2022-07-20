<?php

declare(strict_types=1);

namespace App\Controller\Auth;

use App\Database\User;
use App\Filter\Auth\RegisterRequest;
use Cycle\ORM\EntityManagerInterface;
use Spiral\Auth\AuthScope;
use Spiral\Auth\TokenStorageInterface;
use Spiral\Http\ResponseWrapper;
use Spiral\Router\Annotation\Route;
use Spiral\Views\ViewsInterface;

class RegisterController
{
    #[Route(route: '/register', name: 'register:form', methods: ['GET'])]
    public function index(ViewsInterface $view)
    {
        return $view->render('auth/register');
    }

    #[Route(route: '/register', name: 'register', methods: ['POST'])]
    public function register(
        RegisterRequest $request,
        EntityManagerInterface $entityManager,
        ResponseWrapper $response,
        ViewsInterface $view
    ) {
        if (!$request->isValid()) {
            return $view->render('auth/register', [
                'errors' => $request->getErrors()
            ]);
        }

        $user = new User();
        $user->setEmail($request->email);
        $user->setPassword(password_hash($request->password, PASSWORD_BCRYPT));

        $entityManager->persist($user);
        $entityManager->run();

        return $view->render('auth/login', [
            'registered' => 'Successfully registered'
        ]);
    }
}
