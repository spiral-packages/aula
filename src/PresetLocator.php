<?php

namespace Spiral\Aula;

use Psr\Container\ContainerInterface;
use Spiral\Attributes\ReaderInterface;
use Spiral\Aula\Attribute\Preset;
use Spiral\Tokenizer\ClassesInterface;

class PresetLocator
{
    public function __construct(
        private ClassesInterface $classes,
        private ReaderInterface $reader,
        private ContainerInterface $container
    ) {
    }

    /**
     * @return PresetInterface[]
     */
    public function getPresets(): array
    {
        $presets = [];

        foreach ($this->classes->getClasses(PresetInterface::class) as $class) {
            if ($class->isInterface() || $class->isAbstract()) {
                continue;
            }

            if ($attribute = $this->reader->firstClassMetadata($class, Preset::class)) {
                $presets[$attribute->name] = $this->container->get($class->getName());
            }
        }

        return $presets;
    }
}
