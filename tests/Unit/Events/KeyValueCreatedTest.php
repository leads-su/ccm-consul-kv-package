<?php

namespace ConsulConfigManager\Consul\KeyValue\Test\Unit\Events;

use Illuminate\Support\Arr;
use ConsulConfigManager\Consul\KeyValue\Events\KeyValueCreated;

/**
 * Class KeyValueCreatedTest
 * @package ConsulConfigManager\Consul\KeyValue\Test\Unit\Events
 */
class KeyValueCreatedTest extends AbstractEventTest
{
    /**
     * @inheritDoc
     */
    protected string $activeEventHandler = KeyValueCreated::class;

    /**
     * @param array $data
     *
     * @return void
     * @dataProvider eventDataProvider
     */
    public function testShouldPassIfEventCanBeCreated(array $data): void
    {
        $this->assertInstanceOf(KeyValueCreated::class, $this->createClassInstance($data));
    }

    /**
     * @param array $data
     *
     * @return void
     * @dataProvider eventDataProvider
     */
    public function testShouldPassIfValidDataReturnedFromGetPathMethod(array $data): void
    {
        $this->assertEquals(Arr::get($data, 'path'), $this->createClassInstance($data)->getPath());
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
    protected function createClassInstance(array $data): KeyValueCreated
    {
        return new $this->activeEventHandler(Arr::get($data, 'path'), Arr::get($data, 'value'), Arr::get($data, 'user'));
    }
}
