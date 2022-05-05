<?php

namespace ConsulConfigManager\Consul\KeyValue\Test\Unit\Events;

use Illuminate\Support\Arr;
use ConsulConfigManager\Consul\KeyValue\Events\KeyValuePendingUpdated;

/**
 * Class KeyValuePendingUpdatedTest
 * @package ConsulConfigManager\Consul\KeyValue\Test\Unit\Events
 */
class KeyValuePendingUpdatedTest extends AbstractEventTest
{
    /**
     * @inheritDoc
     */
    protected string $activeEventHandler = KeyValuePendingUpdated::class;

    /**
     * @param array $data
     *
     * @return void
     * @dataProvider eventDataProvider
     */
    public function testShouldPassIfEventCanBeCreated(array $data): void
    {
        $this->assertInstanceOf(KeyValuePendingUpdated::class, $this->createClassInstance($data));
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
    protected function createClassInstance(array $data): KeyValuePendingUpdated
    {
        return new $this->activeEventHandler(Arr::get($data, 'value'), Arr::get($data, 'user'));
    }
}
