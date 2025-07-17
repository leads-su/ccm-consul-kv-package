<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Directory;

/**
 * Class DirectoryListKeysResponseModel
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Directory
 */
class DirectoryListKeysResponseModel
{
    /**
     * Keys list
     * @var array
     */
    private array $keys;

    /**
     * DirectoryListKeysResponseModel constructor.
     * @param array $keys
     * @return void
     */
    public function __construct(array $keys = [])
    {
        $this->keys = $keys;
    }

    /**
     * Get keys list
     * @return array
     */
    public function getKeys(): array
    {
        return $this->keys;
    }

    /**
     * Set keys list
     * @param array $keys
     * @return DirectoryListKeysResponseModel
     */
    public function setKeys(array $keys): DirectoryListKeysResponseModel
    {
        $this->keys = $keys;
        return $this;
    }
}
