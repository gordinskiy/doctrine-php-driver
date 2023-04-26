<?php

declare(strict_types=1);

namespace Gordinskiy\Doctrine\ORM\Mapping\MappingLoader\MappingClassFilters;

class RegexpFilter implements MappingClassFilterInterface
{
    public function __construct(
        private readonly string $patters = '#Mapping.*Mapper$#',
    ) {
    }

    /**
     * @param class-string ...$classes
     * @return class-string[]
     */
    public function filter(string ...$classes): array
    {
        $filteredClasses = [];

        foreach ($classes as $class) {
            if (preg_match($this->patters, $class)) {
                $filteredClasses[] = $class;
            }
        }

        return $filteredClasses;
    }
}
