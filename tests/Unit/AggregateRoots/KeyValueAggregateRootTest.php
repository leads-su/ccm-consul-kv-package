<?php

namespace ConsulConfigManager\Consul\KeyValue\Test\Unit\AggregateRoots;

use ConsulConfigManager\Consul\KeyValue\Events\KeyValueCreated;
use ConsulConfigManager\Consul\KeyValue\Events\KeyValueDeleted;
use ConsulConfigManager\Consul\KeyValue\Events\KeyValueUpdated;
use ConsulConfigManager\Consul\KeyValue\AggregateRoots\KeyValueAggregateRoot;

/**
 * Class KeyValueAggregateRootTest
 * @package ConsulConfigManager\Consul\KeyValue\Test\Unit\AggregateRoots
 */
class KeyValueAggregateRootTest extends AbstractAggregateRootTest
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
        $instance = KeyValueAggregateRoot::retrieve($this->uuid)
            ->createEntity($this->path, $this->value)
            ->persist();
        $this->assertInstanceOf(KeyValueAggregateRoot::class, $instance);
        $this->assertTrue($this->hasEventStored(KeyValueCreated::class));
    }

    /**
     * @return void
     */
    public function testShouldPassIfInstanceOfAggregateRootIsReturnedFromUpdateMethod(): void
    {
        $instance = KeyValueAggregateRoot::retrieve($this->uuid)
            ->createEntity($this->path, $this->value)
            ->updateEntity($this->path, [
                'type'  =>  'string',
                'value' =>  'Hello New World!',
            ])
            ->persist();
        $this->assertInstanceOf(KeyValueAggregateRoot::class, $instance);
        $this->assertTrue($this->hasEventStored(KeyValueCreated::class));
        $this->assertTrue($this->hasEventStored(KeyValueUpdated::class));
    }

    /**
     * @return void
     */
    public function testShouldPassIfInstanceOfAggregateRootIsReturnedFromDeleteMethod(): void
    {
        $instance = KeyValueAggregateRoot::retrieve($this->uuid)
            ->createEntity($this->path, $this->value)
            ->updateEntity($this->path, [
                'type'  =>  'string',
                'value' =>  'Hello New World!',
            ])
            ->deleteEntity($this->path)
            ->persist();
        $this->assertInstanceOf(KeyValueAggregateRoot::class, $instance);
        $this->assertTrue($this->hasEventStored(KeyValueCreated::class));
        $this->assertTrue($this->hasEventStored(KeyValueUpdated::class));
        $this->assertTrue($this->hasEventStored(KeyValueDeleted::class));
    }
}
