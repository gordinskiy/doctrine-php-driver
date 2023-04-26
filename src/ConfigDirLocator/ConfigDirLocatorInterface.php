<?php

declare(strict_types=1);

namespace Gordinskiy\Doctrine\ORM\Mapping\ConfigDirLocator;

interface ConfigDirLocatorInterface
{
    /**
     * @return non-empty-string[]
     */
    public function getAllDirectories(): array;
}
