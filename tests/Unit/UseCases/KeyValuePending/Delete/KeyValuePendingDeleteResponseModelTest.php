<?php

namespace ConsulConfigManager\Consul\KeyValue\Test\Unit\UseCases\KeyValuePending\Delete;

use ConsulConfigManager\Consul\KeyValue\Test\TestCase;
use ConsulConfigManager\Consul\KeyValue\Models\KeyValuePending;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Delete\KeyValuePendingDeleteResponseModel;

/**
 * Class KeyValuePendingDeleteResponseModelTest
 * @package ConsulConfigManager\Consul\KeyValue\Test\Unit\UseCases\KeyValuePending\Delete
 */
class KeyValuePendingDeleteResponseModelTest extends TestCase
{
    /**
     * @return void
     */
    public function testShouldPassWithArrayPassed(): void
    {
        $data = [];
        $instance = new KeyValuePendingDeleteResponseModel($data);
        $this->assertSame([], $instance->getEntity());
    }

    /**
     * @return void
     */
    public function testShouldPassWithNullPassed(): void
    {
        $data = null;
        $instance = new KeyValuePendingDeleteResponseModel($data);
        $this->assertSame([], $instance->getEntity());
    }

    /**
     * @return void
     */
    public function testShouldPassWithEntityPassed(): void
    {
        $data = new KeyValuePending();
        $instance = new KeyValuePendingDeleteResponseModel($data);
        $this->assertSame([], $instance->getEntity());
    }
}
