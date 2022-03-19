<?php

namespace ConsulConfigManager\Consul\KeyValue\Test\Unit\UseCases\KeyValuePending\Get;

use ConsulConfigManager\Consul\KeyValue\Test\TestCase;
use ConsulConfigManager\Consul\KeyValue\Models\KeyValuePending;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Get\KeyValuePendingGetResponseModel;

/**
 * Class KeyValuePendingGetResponseModelTest
 * @package ConsulConfigManager\Consul\KeyValue\Test\Unit\UseCases\KeyValuePending\Get
 */
class KeyValuePendingGetResponseModelTest extends TestCase
{
    /**
     * @return void
     */
    public function testShouldPassWithArrayPassed(): void
    {
        $data = [];
        $instance = new KeyValuePendingGetResponseModel($data);
        $this->assertSame([], $instance->getEntity());
    }

    /**
     * @return void
     */
    public function testShouldPassWithNullPassed(): void
    {
        $data = null;
        $instance = new KeyValuePendingGetResponseModel($data);
        $this->assertSame([], $instance->getEntity());
    }

    /**
     * @return void
     */
    public function testShouldPassWithEntityPassed(): void
    {
        $data = new KeyValuePending();
        $instance = new KeyValuePendingGetResponseModel($data);
        $this->assertSame([], $instance->getEntity());
    }
}
