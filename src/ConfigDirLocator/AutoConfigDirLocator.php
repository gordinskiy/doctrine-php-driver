<?php

declare(strict_types=1);

namespace Gordinskiy\Doctrine\ORM\Mapping\ConfigDirLocator;

class AutoConfigDirLocator implements ConfigDirLocatorInterface
{
    public function __construct(
        private readonly string $rootDir
    ) {
    }

    /**
     * @return non-empty-string[]
     */
    public function getAllDirectories(): array
    {
        $sourcecodeDir = $this->rootDir . DIRECTORY_SEPARATOR . 'src';

        $infrastructureDirectories = self::findDirsWithName($sourcecodeDir, 'Infrastructure');

        $result = [];

        foreach ($infrastructureDirectories as $infrastructureDirectory) {
            foreach (self::findDirsWithName($infrastructureDirectory, 'Mapping') as $foundedDir) {
                $result[] = $foundedDir;
            }
        }

        return $result;
    }

    /**
     * @param non-empty-string $rootDir
     * @param non-empty-string $needle
     * @return non-empty-string[]
     */
    private static function findDirsWithName(string $rootDir, string $needle): array
    {
        $result = [];

        foreach (scandir($rootDir) ?: [] as $dirName) {
            if ($dirName === '.' || $dirName === '..') {
                continue;
            }

            $dirPath = $rootDir . DIRECTORY_SEPARATOR . $dirName;

            if ($dirName === $needle) {
                $result[] = $dirPath;
            } elseif (is_dir($dirPath)) {
                foreach (self::findDirsWithName($dirPath, $needle) as $foundedDir) {
                    $result[] = $foundedDir;
                }
            }
        }

        return $result;
    }
}
