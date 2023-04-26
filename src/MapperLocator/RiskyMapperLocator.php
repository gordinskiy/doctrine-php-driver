<?php

declare(strict_types=1);

namespace Gordinskiy\Doctrine\ORM\Mapping\MapperLocator;

/**
 * @description Considers all files in config directory as Entity Mappers
 */
class RiskyMapperLocator implements MapperLocatorInterface
{
    public function getAllMappers(string $configDir): array
    {
        $entityMappers = [];

        foreach (scandir($configDir) ?: [] as $item) {
            if ($item === '.' || $item === '..') {
                continue;
            }

            $filePath = $configDir . DIRECTORY_SEPARATOR . $item;

            $entityMappers[] = $filePath;
        }

        return $entityMappers;
    }
}
