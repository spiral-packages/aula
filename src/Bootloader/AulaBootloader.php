<?php

declare(strict_types=1);

namespace Spiral\Aula\Bootloader;

use Spiral\Aula\Config\AulaConfig;
use Spiral\Boot\Bootloader\Bootloader;
use Spiral\Config\Patch\Append;
use Spiral\Core\Container;
use Spiral\Config\ConfiguratorInterface;
use Spiral\Aula\Commands;
use Spiral\Console\Bootloader\ConsoleBootloader;

class AulaBootloader extends Bootloader
{
    protected const BINDINGS = [];
    protected const SINGLETONS = [];
    protected const DEPENDENCIES = [
        ConsoleBootloader::class,
    ];

    public function __construct(private ConfiguratorInterface $config)
    {
    }

    public function boot(ConsoleBootloader $console): void
    {
        $this->initConfig();

        $this->config->modify(
            'tokenizer',
            new Append('', 'scopes', [
                'aula' => [
                    'directories' => [__DIR__ . '/../../'],
                ],
            ])
        );

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
