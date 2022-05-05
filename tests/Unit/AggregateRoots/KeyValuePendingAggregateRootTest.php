<?php

namespace ConsulConfigManager\Consul\KeyValue\Test\Unit\AggregateRoots;

use ConsulConfigManager\Consul\KeyValue\Events\KeyValuePendingCreated;
use ConsulConfigManager\Consul\KeyValue\Events\KeyValuePendingDeleted;
use ConsulConfigManager\Consul\KeyValue\Events\KeyValuePendingUpdated;
use ConsulConfigManager\Consul\KeyValue\AggregateRoots\KeyValuePendingAggregateRoot;

/**
 * Class KeyValuePendingAggregateRootTest
 * @package ConsulConfigManager\Consul\KeyValue\Test\Unit\AggregateRoots
 */
class KeyValuePendingAggregateRootTest extends AbstractAggregateRootTest
{
    /**
     * Common UUID value
     * @var string
     */
    protected string $uuid = 'c1dbd8d3-9547-4d2a-a181-ec035fbaaaed';

    /**
     * Common key path
     * @var string
     */
    private string $path = 'consul/test';

    /**
     * Common key value
     * @var array|string[]
     */
    private array $value = [
        'type'  =>  'string',
        'value' =>  'Hello World!',
    ];

    /**
     * @return void
     */
    public function testShouldPassIfInstanceOfAggregateRootIsReturnedFromCreateMethod(): void
    {
        $instance = KeyValuePendingAggregateRoot::retrieve($this->uuid)
            ->createEntity($this->path, $this->value)
            ->persist();
        $this->assertInstanceOf(KeyValuePendingAggregateRoot::class, $instance);
        $this->assertTrue($this->hasEventStored(KeyValuePendingCreated::class));
    }

    /**
     * @return void
     */
    public function testShouldPassIfInstanceOfAggregateRootIsReturnedFromUpdateMethod(): void
    {
        $instance = KeyValuePendingAggregateRoot::retrieve($this->uuid)
            ->createEntity($this->path, $this->value)
            ->updateEntity([
                'type'  =>  'string',
                'value' =>  'Hello New World!',
            ])
            ->persist();
        $this->assertInstanceOf(KeyValuePendingAggregateRoot::class, $instance);
        $this->assertTrue($this->hasEventStored(KeyValuePendingCreated::class));
        $this->assertTrue($this->hasEventStored(KeyValuePendingUpdated::class));
    }

    /**
     * @return void
     */
    public function testShouldPassIfInstanceOfAggregateRootIsReturnedFromDeleteMethod(): void
    {
        $instance = KeyValuePendingAggregateRoot::retrieve($this->uuid)
            ->createEntity($this->path, $this->value)
            ->updateEntity([
                'type'  =>  'string',
                'value' =>  'Hello New World!',
            ])
            ->deleteEntity()
            ->persist();
        $this->assertInstanceOf(KeyValuePendingAggregateRoot::class, $instance);
        $this->assertTrue($this->hasEventStored(KeyValuePendingCreated::class));
        $this->assertTrue($this->hasEventStored(KeyValuePendingUpdated::class));
        $this->assertTrue($this->hasEventStored(KeyValuePendingDeleted::class));
    }
}
