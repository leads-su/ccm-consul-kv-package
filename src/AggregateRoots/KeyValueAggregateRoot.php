<?php

namespace ConsulConfigManager\Consul\KeyValue\AggregateRoots;

use ConsulConfigManager\Consul\KeyValue\Events;
use Spatie\EventSourcing\AggregateRoots\AggregateRoot;
use ConsulConfigManager\Users\Domain\Interfaces\UserEntity;

/**
 * Class KeyValueAggregateRoot
 * @package ConsulConfigManager\Consul\KeyValue\AggregateRoots
 */
class KeyValueAggregateRoot extends AggregateRoot
{
    /**
     * Handle `create` event
     * @param string $path
     * @param array $value
     * @param UserEntity|int|null $user
     * @return $this
     */
    public function createEntity(string $path, array $value, UserEntity|int|null $user = null): KeyValueAggregateRoot
    {
        $this->recordThat(new Events\KeyValueCreated($path, $value, $user));
        return $this;
    }

    /**
     * Handle `update` event
     * @param array $value
     * @param UserEntity|int|null $user
     * @return $this
     */
    public function updateEntity(array $value, UserEntity|int|null $user = null): KeyValueAggregateRoot
    {
        $this->recordThat(new Events\KeyValueUpdated($value, $user));
        return $this;
    }

    /**
     * Handle `delete` event
     * @param UserEntity|int|null $user
     * @return $this
     */
    public function deleteEntity(UserEntity|int|null $user = null): KeyValueAggregateRoot
    {
        $this->recordThat(new Events\KeyValueDeleted($user));
        return $this;
    }
}
