<?php

declare(strict_types=1);

namespace App\Controller\Auth;

use App\Filter\Auth\LoginRequest;
use App\Filter\Auth\LogoutRequest;
use Spiral\Http\Exception\ClientException\BadRequestException;
use Spiral\Prototype\Traits\PrototypeTrait;
use Spiral\Router\Annotation\Route;
use Spiral\Views\ViewsInterface;

class LoginController
{
    use PrototypeTrait;

    #[Route(route: '/login', name: 'login:form', methods: ['GET'])]
    public function index(ViewsInterface $view)
    {
        return $view->render('auth/login');
    }

    #[Route(route: '/login', name: 'login', methods: ['POST'])]
    public function login(LoginRequest $request, ViewsInterface $view)
    {
        $user = $this->users->findByEmail($request->email);

        if ($user === null || !password_verify($request->password, $user->password)) {
            return $view->render('auth/login', [
                'errors' => [
                    [
                        'error'  => 'No such user',
                    ]
                ]
            ]);
        }

        $token = $this->authTokens->create(
            ['userID' => $user->id],
            $request->getSessionExpiration()
        );

        $this->auth->start($token);

        return $view->render('auth/login');
    }

    #[Route(route: '/logout', name: 'logout', methods: ['POST'])]
    public function logout(LogoutRequest $logout)
    {
        if ($this->auth->getToken() === null || $this->auth->getToken()->getID() !== $logout->getToken()) {
            throw new BadRequestException();
        }

        $this->auth->close();

        return $this->response->redirect('/');
    }
}
