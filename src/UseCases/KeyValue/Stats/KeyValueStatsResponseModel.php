<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Stats;

/**
 * Class KeyValueStatsResponseModel
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Stats
 */
class KeyValueStatsResponseModel
{
    /**
     * Entities array
     * @var array
     */
    private array $entities;

    /**
     * KeyValueStatsResponseModel constructor.
     * @param array $entities
     * @return void
     */
    public function __construct(array $entities = [])
    {
        $this->entities = $entities;
    }

    /**
     * Get entities array
     * @return array
     */
    public function getEntities(): array
    {
        return $this->entities;
    }
}
