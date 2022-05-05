<?php

namespace ConsulConfigManager\Consul\KeyValue\Test\Unit\UseCases\KeyValuePending\Structure;

use ConsulConfigManager\Consul\KeyValue\Test\TestCase;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Structure\KeyValuePendingStructureRequestModel;

/**
 * Class KeyValuePendingStructureRequestModelTest
 * @package ConsulConfigManager\Consul\KeyValue\Test\Unit\UseCases\KeyValuePending\Structure
 */
class KeyValuePendingStructureRequestModelTest extends TestCase
{
    public function testShouldPassIfInstanceOfRequestIsReturned(): void
    {
        $request = request();
        $instance = new KeyValuePendingStructureRequestModel($request);
        $this->assertSame($request, $instance->getRequest());
    }
}
