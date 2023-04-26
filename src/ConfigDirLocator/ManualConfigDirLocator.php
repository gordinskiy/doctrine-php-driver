<?php

declare(strict_types=1);

namespace Gordinskiy\Doctrine\ORM\Mapping\ConfigDirLocator;

class ManualConfigDirLocator implements ConfigDirLocatorInterface
{
    /**
     * @param non-empty-string[] $configDirs
     */
    public function __construct(
        private readonly array $configDirs
    ) {
    }

    /**
     * @return non-empty-string[]
     */
    public function getAllDirectories(): array
    {
        return $this->configDirs;
    }
}
