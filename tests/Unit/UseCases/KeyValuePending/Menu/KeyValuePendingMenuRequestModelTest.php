<?php

namespace ConsulConfigManager\Consul\KeyValue\Test\Unit\UseCases\KeyValuePending\Menu;

use ConsulConfigManager\Consul\KeyValue\Test\TestCase;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Menu\KeyValuePendingMenuRequestModel;

/**
 * Class KeyValuePendingMenuRequestModelTest
 * @package ConsulConfigManager\Consul\KeyValue\Test\Unit\UseCases\KeyValuePending\Menu
 */
class KeyValuePendingMenuRequestModelTest extends TestCase
{
    public function testShouldPassIfInstanceOfRequestIsReturned(): void
    {
        $request = request();
        $instance = new KeyValuePendingMenuRequestModel($request);
        $this->assertSame($request, $instance->getRequest());
    }
}
