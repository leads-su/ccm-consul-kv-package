<?php

namespace ConsulConfigManager\Consul\KeyValue\Test\Unit\UseCases\KeyValuePending\Update;

use ConsulConfigManager\Consul\KeyValue\Test\TestCase;
use ConsulConfigManager\Consul\KeyValue\Models\KeyValuePending;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Update\KeyValuePendingUpdateResponseModel;

/**
 * Class KeyValuePendingUpdateResponseModelTest
 * @package ConsulConfigManager\Consul\KeyValue\Test\Unit\UseCases\KeyValuePending\Update
 */
class KeyValuePendingUpdateResponseModelTest extends TestCase
{
    /**
     * @return void
     */
    public function testShouldPassWithArrayPassed(): void
    {
        $data = [];
        $instance = new KeyValuePendingUpdateResponseModel($data);
        $this->assertSame([], $instance->getEntity());
    }

    /**
     * @return void
     */
    public function testShouldPassWithNullPassed(): void
    {
        $data = null;
        $instance = new KeyValuePendingUpdateResponseModel($data);
        $this->assertSame([], $instance->getEntity());
    }

    /**
     * @return void
     */
    public function testShouldPassWithEntityPassed(): void
    {
        $data = new KeyValuePending();
        $instance = new KeyValuePendingUpdateResponseModel($data);
        $this->assertSame([], $instance->getEntity());
    }
}
