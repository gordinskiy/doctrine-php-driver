<?php

declare(strict_types=1);

namespace Gordinskiy\Doctrine\ORM\Mapping\MappingLoader;

use Gordinskiy\Doctrine\ORM\Mapping\EntityMapperInterface;

interface MapperClassLoaderInterface
{
    /**
     * @param non-empty-string ...$mappingFiles
     * @return array<non-empty-string, EntityMapperInterface>
     * @return array<class-string, EntityMapperInterface>
     */
    public function getAllEntityMappers(string ...$mappingFiles): array;
}
