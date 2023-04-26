<?php

declare(strict_types=1);

namespace Gordinskiy\Doctrine\ORM\Mapping\ConfigDirLocator;

// TODO: Benchmark Array Merge
// TODO: Benchmark DirectoryLocator
// TODO: Move Auth mapping to Infrastructure

class ConfigDirLocator implements ConfigDirLocatorInterface
{
    public function __construct(
        private readonly string $rootDir,
        private readonly string $dirPattern,
        private readonly int $maxDepth = 1,
    ) {
    }

    /**
     * @return non-empty-string[]
     */
    public function getAllDirectories(): array
    {
        $sourcecodeDir = $this->rootDir;

        $result = [];

        foreach ($this->findDirsWithName($sourcecodeDir, 1) as $configDir) {
            $result[] = $configDir;
        }

        return $result;
    }

    /**
     * @param non-empty-string $rootDir
     * @param int $depth
     * @return non-empty-string[]
     */
    private function findDirsWithName(string $rootDir, int $depth): array
    {
        $result = [];

        foreach (scandir($rootDir) ?: [] as $dir) {
            if ($dir === '.' || $dir === '..') {
                continue;
            }

            $dirPath = $rootDir . DIRECTORY_SEPARATOR . $dir;
            $confDir = $dirPath . DIRECTORY_SEPARATOR . $this->dirPattern;

            if (is_dir($confDir)) {
                $result[] = $confDir;
            }

            if ($depth < $this->maxDepth && is_dir($dirPath)) {
                foreach ($this->findDirsWithName($dirPath, $depth + 1) as $configDir) {
                    $result[] = $configDir;
                }
            }
        }

        return $result;
    }
}
