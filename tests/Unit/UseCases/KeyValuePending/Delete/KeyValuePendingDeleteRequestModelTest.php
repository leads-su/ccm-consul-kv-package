<?php

namespace ConsulConfigManager\Consul\KeyValue\Test\Unit\UseCases\KeyValuePending\Delete;

use Illuminate\Http\Request;
use ConsulConfigManager\Consul\KeyValue\Test\TestCase;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Delete\KeyValuePendingDeleteRequestModel;

/**
 * Class KeyValuePendingDeleteRequestModelTest
 * @package ConsulConfigManager\Consul\KeyValue\Test\Unit\UseCases\KeyValuePending\Delete
 */
class KeyValuePendingDeleteRequestModelTest extends TestCase
{
    /**
     * @return void
     */
    public function testShouldPassIfInstanceOfRequestIsReturned(): void
    {
        $instance = new KeyValuePendingDeleteRequestModel(request(), '');
        $this->assertInstanceOf(Request::class, $instance->getRequest());
    }
}
