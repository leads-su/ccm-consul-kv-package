<?php

namespace ConsulConfigManager\Consul\KeyValue\AggregateRoots;

use ConsulConfigManager\Consul\KeyValue\Events;
use Spatie\EventSourcing\AggregateRoots\AggregateRoot;
use ConsulConfigManager\Users\Interfaces\UserInterface;

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
     * @param UserInterface|int|null $user
     * @return $this
     */
    public function createEntity(string $path, array $value, UserInterface|int|null $user = null): KeyValueAggregateRoot
    {
        $this->recordThat(new Events\KeyValueCreated($path, $value, $user));
        return $this;
    }

    /**
     * Handle `update` event
     * @param string $path
     * @param array $value
     * @param UserInterface|int|null $user
     * @return $this
     */
    public function updateEntity(string $path, array $value, UserInterface|int|null $user = null): KeyValueAggregateRoot
    {
        $this->recordThat(new Events\KeyValueUpdated($path, $value, $user));
        return $this;
    }

    /**
     * Handle `delete` event
     * @param string $path
     * @param UserInterface|int|null $user
     * @return $this
     */
    public function deleteEntity(string $path, UserInterface|int|null $user = null): KeyValueAggregateRoot
    {
        $this->recordThat(new Events\KeyValueDeleted($path, $user));
        return $this;
    }
}
