<?php

declare(strict_types=1);

namespace Spiral\Aula\Bootloader;

use Spiral\Boot\Bootloader\Bootloader;
use Spiral\Aula\Commands;
use Spiral\Console\Bootloader\ConsoleBootloader;
use Spiral\Tokenizer\Bootloader\TokenizerBootloader;

class AulaBootloader extends Bootloader
{
    protected const BINDINGS = [];
    protected const SINGLETONS = [];

    public function boot(ConsoleBootloader $console, TokenizerBootloader $tokenizer): void
    {
        $tokenizer->addDirectory(directory('vendor') . 'spiral-packages/aula/src');

        $console->addCommand(Commands\InstallCommand::class);
    }
}
