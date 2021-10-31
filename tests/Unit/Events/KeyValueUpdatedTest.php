<?php

namespace ConsulConfigManager\Consul\KeyValue\Test\Unit\Events;

use Illuminate\Support\Arr;
use ConsulConfigManager\Consul\KeyValue\Events\KeyValueUpdated;

/**
 * Class KeyValueUpdatedTest
 * @package ConsulConfigManager\Consul\KeyValue\Test\Unit\Events
 */
class KeyValueUpdatedTest extends AbstractEventTest
{
    /**
     * @inheritDoc
     */
    protected string $activeEventHandler = KeyValueUpdated::class;

    /**
     * @param array $data
     *
     * @return void
     * @dataProvider eventDataProvider
     */
    public function testShouldPassIfEventCanBeCreated(array $data): void
    {
        $this->assertInstanceOf(KeyValueUpdated::class, $this->createClassInstance($data));
    }

    /**
     * @param array $data
     *
     * @return void
     * @dataProvider eventDataProvider
     */
    public function testShouldPassIfValidDataReturnedFromGetValueMethod(array $data): void
    {
        $this->assertEquals(Arr::get($data, 'value'), $this->createClassInstance($data)->getValue());
    }

    /**
     * @inheritDoc
     */
    protected function createClassInstance(array $data): KeyValueUpdated
    {
        return new $this->activeEventHandler(Arr::get($data, 'value'), Arr::get($data, 'user'));
    }
}
