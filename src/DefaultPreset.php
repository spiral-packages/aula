<?php

namespace Spiral\Aula;

use Spiral\Aula\Attribute\Preset;

#[Preset(name: 'Default')]
class DefaultPreset implements PresetInterface
{
    public function publish(string $publishPath): void
    {
//        die(dump($publishPath));
    }

    private function routes() {

    }
}
