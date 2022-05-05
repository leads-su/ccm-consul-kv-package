<?php

namespace ConsulConfigManager\Consul\KeyValue\Test\Unit\UseCases\KeyValue\Namespaced;

use ConsulConfigManager\Consul\KeyValue\Test\TestCase;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Namespaced\KeyValueNamespacedRequestModel;

/**
 * Class KeyValueNamespacedRequestModelTest
 * @package ConsulConfigManager\Consul\KeyValue\Test\Unit\UseCases\KeyValue\Namespaced
 */
class KeyValueNamespacedRequestModelTest extends TestCase
{
    public function testShouldPassIfInstanceOfRequestIsReturned(): void
    {
        $request = request();
        $instance = new KeyValueNamespacedRequestModel($request);
        $this->assertSame($request, $instance->getRequest());
    }
}
