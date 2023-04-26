<?php

declare(strict_types=1);

namespace Gordinskiy\Doctrine\ORM\Mapping\MapperLocator;

/**
 * @description Considers all files in config directory as Entity Mappers
 */
class RiskyIteratorMapperLocator implements MapperLocatorInterface
{
    public function getAllMappers(string $configDir): array
    {
        $entityMappers = [];

        /** @var \SplFileInfo $item */
        foreach (new \FilesystemIterator($configDir, \FilesystemIterator::SKIP_DOTS) as $item) {
            if ($item->isFile()) {
                $entityMappers[] = $item->getPathname();
            }
        }

        return $entityMappers;
    }
}
