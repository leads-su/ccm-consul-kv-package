<?php

namespace ConsulConfigManager\Consul\KeyValue\Test\Unit\UseCases\KeyValuePending\Get;

use Illuminate\Http\Request;
use ConsulConfigManager\Consul\KeyValue\Test\TestCase;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Get\KeyValuePendingGetRequestModel;

/**
 * Class KeyValuePendingGetRequestModelTest
 * @package ConsulConfigManager\Consul\KeyValue\Test\Unit\UseCases\KeyValuePending\Get
 */
class KeyValuePendingGetRequestModelTest extends TestCase
{
    /**
     * @return void
     */
    public function testShouldPassIfInstanceOfRequestIsReturned(): void
    {
        $instance = new KeyValuePendingGetRequestModel(request(), '');
        $this->assertInstanceOf(Request::class, $instance->getRequest());
    }
}
