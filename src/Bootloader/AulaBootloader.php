<?php

declare(strict_types=1);

namespace Spiral\Aula\Bootloader;

use Spiral\Aula\Config\AulaConfig;
use Spiral\Boot\Bootloader\Bootloader;
use Spiral\Config\ConfiguratorInterface;
use Spiral\Aula\Commands;
use Spiral\Console\Bootloader\ConsoleBootloader;
use Spiral\Tokenizer\Bootloader\TokenizerBootloader;

class AulaBootloader extends Bootloader
{
    protected const BINDINGS = [];
    protected const SINGLETONS = [];

    public function __construct(private ConfiguratorInterface $config)
    {
    }

    public function boot(ConsoleBootloader $console, TokenizerBootloader $tokenizer): void
    {
        $this->initConfig();

        $tokenizer->addDirectory(directory('vendor') . 'spiral-packages/aula/src');

        $console->addCommand(Commands\InstallCommand::class);
    }

    private function initConfig(): void
    {
        $this->config->setDefaults(
            AulaConfig::CONFIG,
            []
        );
    }
}
