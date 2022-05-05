<?php

namespace ConsulConfigManager\Consul\KeyValue\Test\Unit\UseCases\KeyValuePending\List;

use Illuminate\Http\Request;
use ConsulConfigManager\Consul\KeyValue\Test\TestCase;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\List\KeyValuePendingListRequestModel;

/**
 * Class KeyValuePendingListRequestModelTest
 * @package ConsulConfigManager\Consul\KeyValue\Test\Unit\UseCases\KeyValuePending\List
 */
class KeyValuePendingListRequestModelTest extends TestCase
{
    /**
     * @return void
     */
    public function testShouldPassIfInstanceOfRequestIsReturned(): void
    {
        $instance = new KeyValuePendingListRequestModel(request());
        $this->assertInstanceOf(Request::class, $instance->getRequest());
    }
}
