<?php

declare(strict_types=1);

namespace App\Controller\Auth;

use App\Filter\Auth\LoginRequest;
use App\Filter\Auth\LogoutRequest;
use App\Repository\UserRepository;
use Spiral\Auth\AuthScope;
use Spiral\Auth\TokenStorageInterface;
use Spiral\Http\Exception\ClientException\BadRequestException;
use Spiral\Http\ResponseWrapper;
use Spiral\Router\Annotation\Route;
use Spiral\Views\ViewsInterface;

class LoginController
{
    #[Route(route: '/login', name: 'login:form', methods: ['GET'])]
    public function index(ViewsInterface $view)
    {
        return $view->render('auth/login');
    }

    #[Route(route: '/login', name: 'login', methods: ['POST'])]
    public function login(
        LoginRequest $request,
        ViewsInterface $view,
        UserRepository $repository,
        ResponseWrapper $response,
        AuthScope $auth,
        TokenStorageInterface $tokenStorage
    ) {
        $user = $repository->findByEmail($request->email);

        if ($user === null || !password_verify($request->password, $user->password)) {
            return $view->render('auth/login', [
                'errors' => [
                    [
                        'error' => 'No such user',
                    ],
                ],
            ]);
        }

        $token = $tokenStorage->create(
            ['userID' => $user->id]
        );

        $auth->start($token);

        return $response->redirect('/');
    }

    #[Route(route: '/logout', name: 'logout', methods: ['POST'])]
    public function logout(LogoutRequest $logout, ResponseWrapper $response)
    {
        if ($this->auth->getToken() === null || $this->auth->getToken()->getID() !== $logout->getToken()) {
            throw new BadRequestException();
        }

        $this->auth->close();

        return $response->redirect('/login');
    }
}
