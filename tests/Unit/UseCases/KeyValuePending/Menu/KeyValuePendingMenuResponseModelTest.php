<?php

namespace ConsulConfigManager\Consul\KeyValue\Test\Unit\UseCases\KeyValuePending\Menu;

use ConsulConfigManager\Consul\KeyValue\Test\TestCase;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Menu\KeyValuePendingMenuResponseModel;

/**
 * Class KeyValuePendingMenuResponseModelTest
 * @package ConsulConfigManager\Consul\KeyValue\Test\Unit\UseCases\KeyValuePending\Menu
 */
class KeyValuePendingMenuResponseModelTest extends TestCase
{
    /**
     * @return void
     */
    public function testShouldPassWithArrayPassed(): void
    {
        $data = [];
        $instance = new KeyValuePendingMenuResponseModel($data);
        $this->assertSame([], $instance->getEntities());
    }

    /**
     * @return void
     */
    public function testShouldPassWithNullPassed(): void
    {
        $data = null;
        $instance = new KeyValuePendingMenuResponseModel($data);
        $this->assertSame([], $instance->getEntities());
    }
}
