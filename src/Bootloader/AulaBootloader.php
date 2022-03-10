<?php

declare(strict_types=1);

namespace Spiral\Aula\Bootloader;

use Spiral\Boot\Bootloader\Bootloader;
use Spiral\Core\Container;
use Spiral\Config\ConfiguratorInterface;
use Spiral\Aula\Commands;
use Spiral\Aula\Config\AulaConfig;
use Spiral\Console\Bootloader\ConsoleBootloader;

class AulaBootloader extends Bootloader
{
    protected const BINDINGS = [];
    protected const SINGLETONS = [];
    protected const DEPENDENCIES = [
        ConsoleBootloader::class
    ];

    public function __construct(private ConfiguratorInterface $config)
    {
    }

    public function boot(Container $container, ConsoleBootloader $console): void
    {
        $this->initConfig();

        $console->addCommand(Commands\InstallCommand::class);
    }

    public function start(Container $container): void
    {
    }

    private function initConfig(): void
    {
        $this->config->setDefaults(
            AulaConfig::CONFIG,
            []
        );
    }
}
