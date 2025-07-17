<?php

namespace ConsulConfigManager\Consul\KeyValue\Interfaces;

use JsonException;
use Consul\Exceptions\RequestException;
use ConsulConfigManager\Consul\KeyValue\Exceptions\KeyValueAlreadyExistsException;
use ConsulConfigManager\Consul\KeyValue\Exceptions\KeyValueDoesNotExistsException;

/**
 * Interface KeyValueServiceInterface
 * @package ConsulConfigManager\Consul\KeyValue\Interfaces
 */
interface KeyValueServiceInterface
{
    /**
     * Get value of specified key
     * @param string $key
     *
     * @throws RequestException
     * @return array
     */
    public function getKeyValue(string $key): array;

    /**
     * Get list of keys in a specified prefix
     * @param string $prefix
     *
     * @throws RequestException
     * @return array
     */
    public function getKeysList(string $prefix = ''): array;

    /**
     * Get keys recursively treating provided key as prefix
     * @param string $prefix
     *
     * @throws RequestException
     * @return array
     */
    public function getKeysValuesInPrefix(string $prefix): array;

    /**
     * Create new KeyValue entry
     * @param string $key
     * @param array  $value
     *
     * @throws JsonException
     * @throws KeyValueAlreadyExistsException
     * @throws RequestException
     * @return bool
     */
    public function createKeyValue(string $key, array $value): bool;

    /**
     * Update existing KeyValue entry
     * @param string $key
     * @param array  $value
     *
     * @throws JsonException
     * @throws KeyValueDoesNotExistsException
     * @return bool
     */
    public function updateKeyValue(string $key, array $value): bool;

    /**
     * Create or Update KeyValue entry
     * @param string $key
     * @param array  $value
     *
     * @throws JsonException
     * @throws RequestException
     * @return bool
     */
    public function createOrUpdateKeyValue(string $key, array $value): bool;

    /**
     * Delete key from Consul
     * @param string $key
     *
     * @throws RequestException
     * @return bool
     */
    public function deleteKey(string $key): bool;

    /**
     * Create a directory structure in Consul KV store
     * @param string $path Directory path (will be normalized with trailing slash)
     *
     * @throws RequestException
     * @return bool
     */
    public function createDirectory(string $path): bool;

    /**
     * Delete a directory and optionally all its contents
     * @param string $path Directory path
     * @param bool $recursive Whether to delete all contents recursively
     *
     * @throws RequestException
     * @return bool
     */
    public function deleteDirectory(string $path, bool $recursive = true): bool;

    /**
     * List all keys within a directory
     * @param string $path Directory path
     *
     * @throws RequestException
     * @return array
     */
    public function listDirectoryKeys(string $path): array;

    /**
     * Get all key-value pairs within a directory recursively
     * @param string $path Directory path
     *
     * @throws RequestException
     * @return array
     */
    public function getDirectoryContents(string $path): array;
}
