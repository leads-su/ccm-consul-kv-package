<?php

namespace ConsulConfigManager\Consul\KeyValue\Test\Unit\Events;

use Illuminate\Support\Arr;
use ConsulConfigManager\Consul\KeyValue\Events\KeyValueDeleted;

/**
 * Class KeyValueDeletedTest
 * @package ConsulConfigManager\Consul\KeyValue\Test\Unit\Events
 */
class KeyValueDeletedTest extends AbstractEventTest
{
    /**
     * @inheritDoc
     */
    protected string $activeEventHandler = KeyValueDeleted::class;

    /**
     * @param array $data
     *
     * @return void
     * @dataProvider eventDataProvider
     */
    public function testShouldPassIfEventCanBeCreated(array $data): void
    {
        $this->assertInstanceOf(KeyValueDeleted::class, $this->createClassInstance($data));
    }

    /**
     * @inheritDoc
     */
    protected function createClassInstance(array $data): KeyValueDeleted
    {
        return new $this->activeEventHandler(Arr::get($data, 'user'));
    }
}
