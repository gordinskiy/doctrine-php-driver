<?php

declare(strict_types=1);

namespace Gordinskiy\Doctrine\ORM\Mapping;

use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;

interface EntityMapperInterface
{
    /**
     * @return class-string
     */
    public static function getMappedEntity(): string;

    public static function loadMetadata(ClassMetadataBuilder $builder): void;
}
