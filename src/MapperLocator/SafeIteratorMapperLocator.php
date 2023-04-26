<?php

declare(strict_types=1);

namespace Gordinskiy\Doctrine\ORM\Mapping\MapperLocator;

class SafeIteratorMapperLocator implements MapperLocatorInterface
{
    public function getAllMappers(string $configDir): array
    {
        $entityMappers = [];

        /** @var \SplFileInfo $item */
        foreach (new \FilesystemIterator($configDir, \FilesystemIterator::SKIP_DOTS) as $item) {
            $entityMappers[] = $item->getPathname();
        }

        return $entityMappers;
    }
}
