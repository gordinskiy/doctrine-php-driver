<?php

declare(strict_types=1);

namespace Gordinskiy\Doctrine\ORM\Mapping\MapperLocator;

class SafeMapperLocator implements MapperLocatorInterface
{
    public function getAllMappers(string $configDir): array
    {
        $entityMappers = [];

        foreach (scandir($configDir) ?: [] as $item) {
            if ($item === '.' || $item === '..') {
                continue;
            }

            $filePath = $configDir . DIRECTORY_SEPARATOR . $item;

            if (is_file($filePath)) {
                $entityMappers[] = $filePath;
            }
        }

        return $entityMappers;
    }
}
