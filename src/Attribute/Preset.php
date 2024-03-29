<?php

declare(strict_types=1);

namespace Spiral\Aula\Attribute;

use Attribute;
use Spiral\Attributes\NamedArgumentConstructor;

#[Attribute(Attribute::TARGET_CLASS), NamedArgumentConstructor]
class Preset
{
    public function __construct(public string $name)
    {
    }
}
