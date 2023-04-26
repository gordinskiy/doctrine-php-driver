<?php

declare(strict_types=1);

namespace Gordinskiy\Doctrine\ORM\Mapping\MappingLoader\MappingClassFilters;

use Gordinskiy\Doctrine\ORM\Mapping\EntityMapperInterface;

class InterfaceFilter implements MappingClassFilterInterface
{
    /**
     * @param class-string ...$classes
     * @return class-string<EntityMapperInterface>[]
     */
    public function filter(string ...$classes): array
    {
        $filteredClasses = [];

        foreach ($classes as $class) {
            if (in_array(EntityMapperInterface::class, class_implements($class))) {
                $filteredClasses[] = $class;
            }
        }

        return $filteredClasses;
    }
}
