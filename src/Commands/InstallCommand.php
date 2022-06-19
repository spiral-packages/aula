<?php

declare(strict_types=1);

namespace Spiral\Aula\Commands;

use Spiral\Aula\PresetLocator;
use Spiral\Boot\DirectoriesInterface;
use Spiral\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class InstallCommand extends Command
{
    protected const NAME = 'aula:install';
    protected const DESCRIPTION = 'Install the aula controllers and resources';
    protected const ARGUMENTS = [
        ['name', InputArgument::REQUIRED, 'Preset name'],
    ];
    protected const OPTIONS = [
        ['dir', 'd', InputOption::VALUE_REQUIRED, 'App directory', 'src'],
    ];

    public function perform(PresetLocator $locator, DirectoriesInterface $dirs): int
    {
        $publishPath = rtrim($dirs->get('app') . $this->option('dir'), '/') . '/';

        foreach ($locator->getPresets() as $name => $preset) {
            if ($this->argument('name') === $name) {
                $preset->publish($publishPath);

                $this->writeln(sprintf('Preset [%s] successfully installed', $name));

                return self::SUCCESS;
            }
        }

        $this->writeln(sprintf('Preset [%s] not found', $this->argument('name')));

        return self::FAILURE;
    }
}
