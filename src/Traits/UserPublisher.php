<?php

namespace Spiral\Aula\Traits;

trait UserPublisher
{
    public function publishUserStubs()
    {
        $this->fileManager->ensureDirectory(self::ROOT_PATH . 'app/src/Repositories/Auth');
        $this->fileManager->ensureDirectory(self::ROOT_PATH . 'app/src/Bootloader');

        copy(self::STUBS_PATH . '/ActorRepository.php', self::ROOT_PATH . 'app/src/Repositories/Auth/ActorRepository.php');
        copy(self::STUBS_PATH . '/UserBootloader.php', self::ROOT_PATH . 'app/src/Bootloader/UserBootloader.php');
    }
}
