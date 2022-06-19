<?php

namespace Spiral\Aula;

use Spiral\Aula\Attribute\Preset;
use Spiral\Files\FilesInterface;

#[Preset(name: 'stempler')]
class StemplerPreset implements PresetInterface
{
    public function __construct(private FilesInterface $fileManager)
    {
    }

    public function publish(string $publishPath): void
    {
        $ensureDirs = ['Bootloader', 'Controller/Auth', 'Database', 'Repository', 'Filter/Auth', '../views/auth/layouts'];

        foreach ($ensureDirs as $dir) {
            $this->fileManager->ensureDirectory($publishPath . $dir);
        }

        copy(
            __DIR__ . '/../src/Bootloader/UserBootloader.php',
            $publishPath . 'Bootloader/UserBootloader.php'
        );

        copy(
            __DIR__ . '/../stubs/stempler/Controller/LoginController.php',
            $publishPath . 'Controller/Auth/LoginController.php'
        );
        copy(
            __DIR__ . '/../stubs/stempler/Controller/RegisterController.php',
            $publishPath . 'Controller/Auth/RegisterController.php'
        );
        copy(
            __DIR__ . '/../stubs/UserRepository.php',
            $publishPath . 'Repository/UserRepository.php'
        );
        copy(
            __DIR__ . '/../stubs/stempler/Filter/LoginRequest.php',
            $publishPath . 'Filter/Auth/LoginRequest.php'
        );
        copy(
            __DIR__ . '/../stubs/stempler/Filter/RegisterRequest.php',
            $publishPath . 'Filter/Auth/RegisterRequest.php'
        );
        copy(
            __DIR__ . '/../stubs/stempler/Filter/LogoutRequest.php',
            $publishPath . 'Filter/Auth/LogoutRequest.php'
        );

        copy(__DIR__ . '/../stubs/User.php', $publishPath . 'Database/User.php');

        copy(
            __DIR__ . '/../stubs/stempler/resources/views/layouts/app.dark.php',
            $publishPath . '../views/auth/layouts/app.dark.php'
        );

        copy(
            __DIR__ . '/../stubs/stempler/resources/views/login.dark.php',
            $publishPath . '../views/auth/login.dark.php'
        );
        copy(
            __DIR__ . '/../stubs/stempler/resources/views/register.dark.php',
            $publishPath . '../views/auth/register.dark.php'
        );
    }
}
