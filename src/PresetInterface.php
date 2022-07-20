<?php

declare(strict_types=1);

namespace Spiral\Aula;

interface PresetInterface
{
    public function publish(string $publishPath): void;
}
