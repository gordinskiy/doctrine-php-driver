<?php

declare(strict_types=1);

namespace Gordinskiy\Doctrine\ORM\Mapping;

use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;
use Doctrine\Persistence\Mapping\ClassMetadata;
use Doctrine\Persistence\Mapping\Driver\MappingDriver as MappingDriverInterface;
use Gordinskiy\Doctrine\ORM\Mapping\ConfigDirLocator\ConfigDirLocatorInterface;
use Gordinskiy\Doctrine\ORM\Mapping\MapperLocator\MapperLocatorInterface;
use Gordinskiy\Doctrine\ORM\Mapping\MappingLoader\MapperClassLoader;

final class MappingDriver implements MappingDriverInterface
{
    /**
     * @var array<class-string, EntityMapperInterface>
     */
    private array $entityConfigurations = [];

    public function __construct(
        private readonly ConfigDirLocatorInterface $configDirLocator,
        private readonly MapperLocatorInterface $mapperLocator,
        private readonly MapperClassLoader $mapperClassLoader = new MapperClassLoader(),
    ) {
    }

    private function init(): void
    {
        if (empty($this->entityConfigurations)) {
            $mappingFiles = [];

            foreach ($this->configDirLocator->getAllDirectories() as $configDir) {
                foreach ($this->mapperLocator->getAllMappers($configDir) as $entityMapper) {
                    $mappingFiles[] = $entityMapper;
                }
            }

            $this->entityConfigurations = $this->mapperClassLoader->getAllEntityMappers(...$mappingFiles);
        }
    }

    /**
     * @inheritDoc
     */
    public function loadMetadataForClass($className, ClassMetadata $metadata): void
    {
        $this->init();

        if (isset($this->entityConfigurations[$className]) && !empty($this->entityConfigurations[$className])) {
            if ($this->entityConfigurations[$className] instanceof EntityMapperInterface) {
                $this->entityConfigurations[$className]->loadMetadata(new ClassMetadataBuilder($metadata));
            }
        }
    }

    /**
     * @inheritDoc
     */
    public function getAllClassNames(): array
    {
        $this->init();

        return array_keys($this->entityConfigurations);
    }

    /**
     * @inheritDoc
     */
    public function isTransient($className): bool
    {
        $this->init();

        return !array_key_exists($className, $this->entityConfigurations);
    }
}
