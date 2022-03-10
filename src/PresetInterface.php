<?php

namespace Spiral\Aula;

interface PresetInterface
{
    public function publish(string $publishPath): void;
}
