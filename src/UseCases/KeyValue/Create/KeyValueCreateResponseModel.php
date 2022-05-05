<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Create;

use ConsulConfigManager\Consul\KeyValue\Interfaces\KeyValueInterface;

/**
 * Class KeyValueCreateResponseModel
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Create
 */
class KeyValueCreateResponseModel
{
    /**
     * Entity instance
     * @var KeyValueInterface|array|null
     */
    private KeyValueInterface|array|null $entity;

    /**
     * KeyValueCreateResponseModel constructor.
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
