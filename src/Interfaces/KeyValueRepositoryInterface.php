<?php

namespace ConsulConfigManager\Consul\KeyValue\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Interface KeyValueRepositoryInterface
 * @package ConsulConfigManager\Consul\KeyValue\Interfaces
 */
interface KeyValueRepositoryInterface
{
    /**
     * Get list of all KV entries from database
     * @param array|string[] $columns
     *
     * @return Collection
     */
    public function all(array $columns = ['*']): Collection;

    /**
     * Get list of all KV entries as a list of keys
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
     * @return KeyValueInterface|null
     */
    public function find(string $path, array $columns = ['*']): KeyValueInterface|null;

    /**
     * Find entity by path or fail
     * @param string         $path
     * @param array|string[] $columns
     *
     * @throws ModelNotFoundException
     * @return KeyValueInterface
     */
    public function findOrFail(string $path, array $columns = ['*']): KeyValueInterface;

    /**
     * Get list of changes applied to model
     * @param string $path
     *
     * @return \Illuminate\Support\Collection
     */
    public function changelog(string $path): \Illuminate\Support\Collection;

    /**
     * Create new entity
     * @param string $path
     * @param array  $value
     *
     * @return KeyValueInterface
     */
    public function create(string $path, array $value): KeyValueInterface;

    /**
     * Update existing entity
     * @param string $path
     * @param array  $value
     *
     * @return KeyValueInterface
     */
    public function update(string $path, array $value): KeyValueInterface;

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

    /**
     * Retrieve list of references from database
     * @return array
     */
    public function references(): array;
}
