<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Update;

use ConsulConfigManager\Consul\KeyValue\Interfaces\KeyValueInterface;

/**
 * Class KeyValueUpdateResponseModel
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Update
 */
class KeyValueUpdateResponseModel
{
    /**
     * Entity instance
     * @var KeyValueInterface|array|null
     */
    private KeyValueInterface|array|null $entity;

    /**
     * KeyValueUpdateResponseModel constructor.
     * @param KeyValueInterface|array|null $entity
     * @return void
     */
    public function __construct(KeyValueInterface|array|null $entity = null)
    {
        $this->entity = $entity;
    }

    /**
     * Get entity as array
     * @return array
     */
    public function getEntity(): array
    {
        if ($this->entity === null) {
            return [];
        } elseif (is_array($this->entity)) {
            return $this->entity;
        }
        return $this->entity->toArray();
    }
}
