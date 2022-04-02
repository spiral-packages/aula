<?php

namespace Spiral\Aula;

use Spiral\Aula\Attribute\Preset;

#[Preset(name: 'default')]
class DefaultPreset implements PresetInterface
{
    public function publish(string $publishPath): void
    {
    }
}
