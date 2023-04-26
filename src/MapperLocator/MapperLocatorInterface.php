<?php

declare(strict_types=1);

namespace Gordinskiy\Doctrine\ORM\Mapping\MapperLocator;

interface MapperLocatorInterface
{
    /**
     * @param non-empty-string $configDir
     * @return non-empty-string[]
     */
    public function getAllMappers(string $configDir): array;
}
