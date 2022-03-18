<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Menu;

/**
 * Class KeyValueMenuResponseModel
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\Menu
 */
class KeyValueMenuResponseModel
{
    /**
     * Entities list
     * @var array|null
     */
    private array|null $entities;

    /**
     * KeyValueMenuResponseModel constructor.
     * @param array|null $entities
     * @return void
     */
    public function __construct(array|null $entities = null)
    {
        $this->entities = $entities;
    }

    /**
     * Get list of entities
     * @return array
     */
    public function getEntities(): array
    {
        if ($this->entities === null) {
            return [];
        }
        return $this->entities;
    }
}
