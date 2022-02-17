<?php

declare(strict_types=1);

namespace Spiral\Aula\Config;

use Spiral\Core\InjectableConfig;

final class AulaConfig extends InjectableConfig
{
    public const CONFIG = 'aula';
    protected $config = [];
}
