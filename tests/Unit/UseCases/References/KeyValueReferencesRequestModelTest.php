<?php

namespace ConsulConfigManager\Consul\KeyValue\Test\Unit\UseCases\References;

use ConsulConfigManager\Consul\KeyValue\Test\TestCase;
use ConsulConfigManager\Consul\KeyValue\UseCases\References\KeyValueReferencesRequestModel;

/**
 * Class KeyValueReferencesRequestModelTest
 * @package ConsulConfigManager\Consul\KeyValue\Test\Unit\UseCases\References
 */
class KeyValueReferencesRequestModelTest extends TestCase
{
    public function testShouldPassIfInstanceOfRequestIsReturned(): void
    {
        $request = request();
        $instance = new KeyValueReferencesRequestModel($request);
        $this->assertSame($request, $instance->getRequest());
    }
}
