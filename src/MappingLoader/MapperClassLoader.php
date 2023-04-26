<?php

declare(strict_types=1);

namespace Gordinskiy\Doctrine\ORM\Mapping\MappingLoader;

use Gordinskiy\Doctrine\ORM\Mapping\EntityMapperInterface;
use Gordinskiy\Doctrine\ORM\Mapping\MappingLoader\{
    MappingClassFilters\FilterChain,
    MappingClassFilters\InterfaceFilter,
    MappingClassFilters\MappingClassFilterInterface,
    MappingClassFilters\RegexpFilter,
};

class MapperClassLoader implements MapperClassLoaderInterface
{
    public function __construct(
        private readonly MappingClassFilterInterface $filter = new FilterChain(
            new RegexpFilter(),
            new InterfaceFilter(),
        )
    ) {
    }

    /**
     * @inheritDoc
     */
    public function getAllEntityMappers(string ...$mappingFiles): array
    {
        foreach ($mappingFiles as $mappingFile) {
            require_once $mappingFile;
        }

        $entityMappers = [];

        foreach ($this->filter->filter(...get_declared_classes()) as $class) {
            $mapper = new $class();

            if ($mapper instanceof EntityMapperInterface) {
                $entityMappers[$mapper->getMappedEntity()] = $mapper;
            }
        }

        return $entityMappers;
    }
}
