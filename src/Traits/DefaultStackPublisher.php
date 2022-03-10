<?php

declare(strict_types=1);

namespace Spiral\Aula\Traits;

use Nette\PhpGenerator\PhpFile;
use App\Controller\Auth\LoginController;
use Spiral\Router\Target\Action;

trait DefaultStackPublisher
{
    protected function publishDefaultStack()
    {
        $this->publishDefaultControllers();
        $this->publishDefaultRoutes();
        $this->publishDefaultViews();
    }

    protected function publishDefaultRoutes()
    {
        $path = self::ROOT_PATH . 'app/src/Bootloader/RoutesBootloader.php';

        $bootloader = PhpFile::fromCode(file_get_contents($path));

        $bootloader->getNamespaces()['App\Bootloader']
            ->addUse(LoginController::class)
            ->addUse(Action::class);

        $bootloader->getClasses()['App\Bootloader\RoutesBootloader']
            ->getMethod('boot')
            ->addBody(
                <<<'EOL'


            $router->setRoute(
                'login.create',
                (new Route('/login', new Action(LoginController::class, 'create')))->withVerbs('GET')
            );

            $router->setRoute(
                'login.store',
                (new Route('/login', new Action(LoginController::class, 'store')))->withVerbs('POST')
            );
            EOL
            );

        file_put_contents(self::ROOT_PATH . 'app/src/Bootloader/RoutesBootloader.php', strval($bootloader));
    }

    protected function publishDefaultControllers()
    {
        $controllersPath = self::ROOT_PATH . 'app/src/Controller/Auth';
        $requestsPath = self::ROOT_PATH . 'app/src/Requests/Auth';

        $this->fileManager->ensureDirectory($controllersPath);
        $this->fileManager->ensureDirectory($requestsPath);

        copy(self::STUBS_PATH . 'default/Controllers/LoginController.php', $controllersPath . '/LoginController.php');
        copy(self::STUBS_PATH . 'default/Requests/LoginRequest.php', $requestsPath . '/LoginRequest.php');
    }

    protected function publishDefaultViews()
    {
        $this->fileManager->ensureDirectory(self::ROOT_PATH . 'app/views/auth/layouts');

        copy(
            self::STUBS_PATH . 'default/resources/views/layouts/app.dark.php',
            self::ROOT_PATH . 'app/views/auth/layouts/app.dark.php'
        );
        copy(
            self::STUBS_PATH . 'default/resources/views/login.dark.php',
            self::ROOT_PATH . 'app/views/auth/login.dark.php'
        );
    }
}
