<?php

declare(strict_types=1);

namespace Gordinskiy\Doctrine\ORM\Mapping\MappingLoader\MappingClassFilters;

interface MappingClassFilterInterface
{
    /**
     * @param class-string ...$classes
     * @return class-string[]
     */
    public function filter(string ...$classes): array;
}
