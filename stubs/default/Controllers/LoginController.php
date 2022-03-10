<?php

declare(strict_types=1);

namespace App\Controller\Auth;

use Spiral\Aula\Stubs\UserRepositoryInterface;
use Spiral\Router\Annotation\Route;
use Spiral\Views\ViewsInterface;
use App\Requests\Auth\LoginRequest;

class LoginController
{
    #[Route(name: 'login.create', route: 'auth/login', methods: ['GET'])]
    public function create(ViewsInterface $view)
    {
        return $view->render('auth/login');
    }

    public function store(LoginRequest $request, UserRepositoryInterface $userRepository)
    {
        if (!$request->isValid()) {
            return [
                'status' => 400,
                'errors' => $request->getErrors()
            ];
        }

        $user = $userRepository->findOne($request->getField('username'));
        if (
            $user === null
            || !password_verify($request->getField('password'), $user->password)
        ) {
            return [
                'status' => 400,
                'error'  => 'No such user'
            ];
        }

        $this->auth->start(
            $this->authTokens->create(['userID' => $user->id])
        );

        return [
            'status'  => 200,
            'message' => 'Authenticated!'
        ];
    }
}
