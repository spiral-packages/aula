<?php

declare(strict_types=1);

namespace Spiral\Aula\Commands;

use Spiral\Console\Command;

class AulaCommand extends Command
{
    protected const NAME = 'aula';
    protected const DESCRIPTION = 'My command';
    protected const ARGUMENTS = [];

    public function perform(): int
    {
        return self::SUCCESS;
    }
}
