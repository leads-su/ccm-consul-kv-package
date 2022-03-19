<?php

namespace ConsulConfigManager\Consul\KeyValue\Test\Unit\UseCases\KeyValue\Menu;

use ConsulConfigManager\Consul\KeyValue\Test\TestCase;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Menu\KeyValueMenuResponseModel;

/**
 * Class KeyValueMenuResponseModelTest
 * @package ConsulConfigManager\Consul\KeyValue\Test\Unit\UseCases\KeyValue\Menu
 */
class KeyValueMenuResponseModelTest extends TestCase
{
    /**
     * @return void
     */
    public function testShouldPassWithArrayPassed(): void
    {
        $data = [];
        $instance = new KeyValueMenuResponseModel($data);
        $this->assertSame([], $instance->getEntities());
    }

    /**
     * @return void
     */
    public function testShouldPassWithNullPassed(): void
    {
        $data = null;
        $instance = new KeyValueMenuResponseModel($data);
        $this->assertSame([], $instance->getEntities());
    }
}
