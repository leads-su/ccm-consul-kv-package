<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\Get;

use ConsulConfigManager\Consul\KeyValue\Interfaces\KeyValueInterface;

/**
 * Class KeyValueGetResponseModel
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\Get
 */
class KeyValueGetResponseModel
{
    /**
     * KeyValue model instance
     * @var KeyValueInterface|null
     */
    private ?KeyValueInterface $keyValueEntity;

    /**
     * KeyValueGetResponseModel constructor.
     * @param KeyValueInterface|null $keyValueEntity
     * @return void
     */
    public function __construct(?KeyValueInterface $keyValueEntity = null)
    {
        $this->keyValueEntity = $keyValueEntity;
    }

    /**
     * Get key-value
     * @return KeyValueInterface|null
     */
    public function getKeyValue(): ?KeyValueInterface
    {
        return $this->keyValueEntity;
    }
}
