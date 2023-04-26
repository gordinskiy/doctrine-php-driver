<?php

declare(strict_types=1);

namespace Gordinskiy\Doctrine\ORM\Mapping\MappingLoader\MappingClassFilters;

class FilterChain implements MappingClassFilterInterface
{
    /**
     * @var MappingClassFilterInterface[]
     */
    private readonly array $filters;

    public function __construct(
        MappingClassFilterInterface ...$filters,
    ) {
        $this->filters = $filters;
    }

    /**
     * @param class-string ...$classes
     * @return class-string[]
     */
    public function filter(string ...$classes): array
    {
        foreach ($this->filters as $filter) {
            $classes = $filter->filter(...$classes);
        }

        return $classes;
    }
}
