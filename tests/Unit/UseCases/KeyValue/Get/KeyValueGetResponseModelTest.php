<?php

namespace ConsulConfigManager\Consul\KeyValue\Test\Unit\UseCases\KeyValue\Get;

use ConsulConfigManager\Consul\KeyValue\Test\TestCase;
use ConsulConfigManager\Consul\KeyValue\Models\KeyValue;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Get\KeyValueGetResponseModel;

/**
 * Class KeyValueGetResponseModelTest
 * @package ConsulConfigManager\Consul\KeyValue\Test\Unit\UseCases\KeyValue\Get
 */
class KeyValueGetResponseModelTest extends TestCase
{
    /**
     * @return void
     */
    public function testShouldPassWithArrayPassed(): void
    {
        $data = [];
        $instance = new KeyValueGetResponseModel($data);
        $this->assertSame([], $instance->getKeyValue());
    }

    /**
     * @return void
     */
    public function testShouldPassWithNullPassed(): void
    {
        $data = null;
        $instance = new KeyValueGetResponseModel($data);
        $this->assertSame([], $instance->getKeyValue());
    }

    /**
     * @return void
     */
    public function testShouldPassWithEntityPassed(): void
    {
        $data = new KeyValue();
        $instance = new KeyValueGetResponseModel($data);
        $this->assertSame([], $instance->getKeyValue());
    }
}
