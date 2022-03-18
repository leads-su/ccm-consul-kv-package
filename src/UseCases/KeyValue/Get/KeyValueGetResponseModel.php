<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Get;

use ConsulConfigManager\Consul\KeyValue\Interfaces\KeyValueInterface;

/**
 * Class KeyValueGetResponseModel
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\Get
 */
class KeyValueGetResponseModel
{
    /**
     * KeyValue model instance
     * @var KeyValueInterface|array|null
     */
    private KeyValueInterface|array|null $keyValueEntity;

    /**
     * KeyValueGetResponseModel constructor.
     * @param KeyValueInterface|array|null $keyValueEntity
     * @return void
     */
    public function __construct(KeyValueInterface|array|null $keyValueEntity = null)
    {
        $this->keyValueEntity = $keyValueEntity;
    }

    /**
     * Get key-value
     * @return array
     */
    public function getKeyValue(): array
    {
        if (is_array($this->keyValueEntity)) {
            return $this->keyValueEntity;
        } elseif (is_null($this->keyValueEntity)) {
            return [];
        }
        return $this->keyValueEntity->toArray();
    }
}
