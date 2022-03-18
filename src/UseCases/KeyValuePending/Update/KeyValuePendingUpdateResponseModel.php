<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Update;

use ConsulConfigManager\Consul\KeyValue\Interfaces\KeyValuePendingInterface;

/**
 * Class KeyValuePendingUpdateResponseModel
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Update
 */
class KeyValuePendingUpdateResponseModel
{
    /**
     * Entity instance
     * @var KeyValuePendingInterface|array|null
     */
    private KeyValuePendingInterface|array|null $entity;

    /**
     * KeyValuePendingUpdateResponseModel constructor.
     * @param KeyValuePendingInterface|array|null $entity
     * @return void
     */
    public function __construct(KeyValuePendingInterface|array|null $entity = null)
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
