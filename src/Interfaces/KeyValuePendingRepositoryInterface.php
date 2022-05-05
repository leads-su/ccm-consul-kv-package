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
     * Get total count of entities in the database
     * @return int
     */
    public function count(): int;

    /**
     * Get count of entities matching specified condition
     * @param string $field
     * @param mixed $value
     * @param string $operator
     * @return int
     */
    public function countForField(string $field, mixed $value, string $operator = '='): int;

    /**
     * Get list of all entities as a list of keys
     * @return array
     */
    public function allKeys(): array;

    /**
     * Get list of all KV entries from database in a namespaced style
     * @param array|string[] $columns
     *
     * @return array
     */
    public function allNamespaced(array $columns = ['*']): array;

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
