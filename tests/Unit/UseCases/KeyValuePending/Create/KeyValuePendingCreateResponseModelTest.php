<?php

namespace ConsulConfigManager\Consul\KeyValue\Test\Unit\UseCases\KeyValuePending\Create;

use ConsulConfigManager\Consul\KeyValue\Test\TestCase;
use ConsulConfigManager\Consul\KeyValue\Models\KeyValuePending;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Create\KeyValuePendingCreateResponseModel;

/**
 * Class KeyValuePendingCreateResponseModelTest
 * @package ConsulConfigManager\Consul\KeyValue\Test\Unit\UseCases\KeyValuePending\Create
 */
class KeyValuePendingCreateResponseModelTest extends TestCase
{
    /**
     * @return void
     */
    public function testShouldPassWithArrayPassed(): void
    {
        $data = [];
        $instance = new KeyValuePendingCreateResponseModel($data);
        $this->assertSame([], $instance->getEntity());
    }

    /**
     * @return void
     */
    public function testShouldPassWithNullPassed(): void
    {
        $data = null;
        $instance = new KeyValuePendingCreateResponseModel($data);
        $this->assertSame([], $instance->getEntity());
    }

    /**
     * @return void
     */
    public function testShouldPassWithEntityPassed(): void
    {
        $data = new KeyValuePending();
        $instance = new KeyValuePendingCreateResponseModel($data);
        $this->assertSame([], $instance->getEntity());
    }
}
