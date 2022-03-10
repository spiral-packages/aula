<?php

declare(strict_types=1);

namespace Spiral\Aula\Commands;

use Spiral\Aula\PresetLocator;
use Spiral\Boot\DirectoriesInterface;
use Spiral\Console\Command;
use Spiral\Files\Files;
use Symfony\Component\Console\Input\InputArgument;

class InstallCommand extends Command
{
    protected const NAME = 'aula:install';
    protected const DESCRIPTION = 'Install the aula controllers and resources';
    protected const ARGUMENTS = [
        ['name', InputArgument::REQUIRED, 'Preset name'],
    ];

    protected Files $fileManager;

    public function __construct(string $name = null)
    {
        parent::__construct($name);

        $this->fileManager = new Files();
    }

    public function perform(PresetLocator $locator, DirectoriesInterface $dirs): int
    {
        foreach ($locator->getPresets() as $name => $preset) {
            if ($this->argument('name') === $name) {
                $preset->publish($dirs->get('root'));

                $this->writeln(sprintf('Preset [%s] successfully installed', $name));

                return self::SUCCESS;
            }
        }

        $this->writeln(sprintf('Preset [%s] not found', $this->argument('name')));

        return self::FAILURE;
    }
}
