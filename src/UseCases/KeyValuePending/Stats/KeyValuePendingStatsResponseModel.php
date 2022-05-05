<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Stats;

/**
 * Class KeyValuePendingStatsResponseModel
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Stats
 */
class KeyValuePendingStatsResponseModel
{
    /**
     * Entities array
     * @var array
     */
    private array $entities;

    /**
     * KeyValuePendingStatsResponseModel constructor.
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
