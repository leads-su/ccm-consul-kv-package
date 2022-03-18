<?php

namespace ConsulConfigManager\Consul\KeyValue\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Interface KeyValuePendingRepositoryInterface
 * @package ConsulConfigManager\Consul\KeyValue\Interfaces
 */
interface KeyValuePendingRepositoryInterface
{
    /**
     * Get list of all entities from database
     * @param array|string[] $columns
     *
     * @return Collection
     */
    public function all(array $columns = ['*']): Collection;

    /**
     * Get list of all entities as a list of keys
     * @return array
     */
    public function allKeys(): array;

    /**
     * Find entity by path
     * @param string         $path
     * @param array|string[] $columns
     *
     * @return KeyValuePendingInterface|null
     */
    public function find(string $path, array $columns = ['*']): KeyValuePendingInterface|null;

    /**
     * Find entity by path or fail
     * @param string         $path
     * @param array|string[] $columns
     *
     * @throws ModelNotFoundException
     * @return KeyValuePendingInterface
     */
    public function findOrFail(string $path, array $columns = ['*']): KeyValuePendingInterface;

    /**
     * Create new entity
     * @param string $path
     * @param array  $value
     *
     * @return KeyValuePendingInterface
     */
    public function create(string $path, array $value): KeyValuePendingInterface;

    /**
     * Update existing entity
     * @param string $path
     * @param array  $value
     *
     * @return KeyValuePendingInterface
     */
    public function update(string $path, array $value): KeyValuePendingInterface;

    /**
     * Delete existing entity
     * @param string $path
     * @param bool   $forceDelete
     *
     * @return bool
     */
    public function delete(string $path, bool $forceDelete = false): bool;

    /**
     * Force delete existing entity
     * @param string $path
     *
     * @return bool
     */
    public function forceDelete(string $path): bool;
}
