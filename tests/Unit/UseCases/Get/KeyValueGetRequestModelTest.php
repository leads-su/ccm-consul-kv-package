<?php

namespace ConsulConfigManager\Consul\KeyValue\Test\Unit\UseCases\Get;

use ConsulConfigManager\Consul\KeyValue\Test\TestCase;
use ConsulConfigManager\Consul\KeyValue\UseCases\Get\KeyValueGetRequestModel;

/**
 * Class KeyValueGetRequestModelTest
 * @package ConsulConfigManager\Consul\KeyValue\Test\Unit\UseCases\Get
 */
class KeyValueGetRequestModelTest extends TestCase
{
    public function testShouldPassIfInstanceOfRequestIsReturned(): void
    {
        $request = request();
        $instance = new KeyValueGetRequestModel($request, 'example/test');
        $this->assertSame($request, $instance->getRequest());
    }
}
