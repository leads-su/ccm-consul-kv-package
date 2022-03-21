<?php

namespace ConsulConfigManager\Consul\KeyValue\Test\Unit\UseCases\KeyValue\Update;

use ConsulConfigManager\Consul\KeyValue\Test\TestCase;
use ConsulConfigManager\Consul\KeyValue\Models\KeyValue;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Update\KeyValueUpdateResponseModel;

/**
 * Class KeyValueUpdateResponseModelTest
 * @package ConsulConfigManager\Consul\KeyValue\Test\Unit\UseCases\KeyValue\Update
 */
class KeyValueUpdateResponseModelTest extends TestCase
{
    /**
     * @return void
     */
    public function testShouldPassWithArrayPassed(): void
    {
        $data = [];
        $instance = new KeyValueUpdateResponseModel($data);
        $this->assertSame([], $instance->getEntity());
    }

    /**
     * @return void
     */
    public function testShouldPassWithNullPassed(): void
    {
        $data = null;
        $instance = new KeyValueUpdateResponseModel($data);
        $this->assertSame([], $instance->getEntity());
    }

    /**
     * @return void
     */
    public function testShouldPassWithEntityPassed(): void
    {
        $data = new KeyValue();
        $instance = new KeyValueUpdateResponseModel($data);
        $this->assertSame([], $instance->getEntity());
    }
}
