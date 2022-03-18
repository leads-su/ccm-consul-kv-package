<?php

namespace ConsulConfigManager\Consul\KeyValue\Repositories;

use Throwable;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Collection;
use ConsulConfigManager\Consul\KeyValue\Models\KeyValuePending;
use ConsulConfigManager\Consul\KeyValue\Interfaces\KeyValuePendingInterface;
use ConsulConfigManager\Consul\KeyValue\AggregateRoots\KeyValuePendingAggregateRoot;
use ConsulConfigManager\Consul\KeyValue\Interfaces\KeyValuePendingRepositoryInterface;

/**
 * Class KeyValuePendingRepository
 * @package ConsulConfigManager\Consul\KeyValue\Repositories
 */
class KeyValuePendingRepository implements KeyValuePendingRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function all(array $columns = ['*']): Collection
    {
        return KeyValuePending::all($columns);
    }

    /**
     * @inheritDoc
     */
    public function allKeys(): array
    {
        return array_map(static function (array $entity): string {
            return Arr::get($entity, 'path');
        }, $this->all()->toArray());
    }

    /**
     * @inheritDoc
     */
    public function find(string $path, array $columns = ['*']): KeyValuePendingInterface|null
    {
        return KeyValuePending::where('path', '=', $path)->first($columns);
    }

    /**
     * @inheritDoc
     */
    public function findOrFail(string $path, array $columns = ['*']): KeyValuePendingInterface
    {
        return KeyValuePending::where('path', '=', $path)->firstOrFail($columns);
    }

    /**
     * @inheritDoc
     */
    public function create(string $path, array $value): KeyValuePendingInterface
    {
        $uuid = Str::uuid()->toString();
        $path = trim($path);

        KeyValuePendingAggregateRoot::retrieve($uuid)
            ->createEntity($path, $value)
            ->persist();

        return $this->find($path);
    }

    /**
     * @inheritDoc
     */
    public function update(string $path, array $value): KeyValuePendingInterface
    {
        $path = trim($path);
        $model = $this->findOrFail($path, ['uuid']);

        KeyValuePendingAggregateRoot::retrieve($model->getUuid())
            ->updateEntity($value)
            ->persist();

        return $this->find($path);
    }

    /**
     * @inheritDoc
     */
    public function delete(string $path, bool $forceDelete = false): bool
    {
        try {
            $path = trim($path);
            $model = $this->findOrFail($path, ['uuid']);

            KeyValuePendingAggregateRoot::retrieve($model->getUuid())
                ->deleteEntity()
                ->persist();

            return true;
        } catch (Throwable) {
            return false;
        }
    }

    /**
     * @inheritDoc
     */
    public function forceDelete(string $path): bool
    {
        return $this->delete($path, true);
    }
}
