<?php

namespace ConsulConfigManager\Consul\KeyValue\Test\Unit\UseCases\KeyValue\Delete;

use Illuminate\Http\Request;
use ConsulConfigManager\Consul\KeyValue\Test\TestCase;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Delete\KeyValueDeleteRequestModel;

/**
 * Class KeyValueDeleteRequestModelTest
 * @package ConsulConfigManager\Consul\KeyValue\Test\Unit\UseCases\KeyValue\Delete
 */
class KeyValueDeleteRequestModelTest extends TestCase
{
    /**
     * @return void
     */
    public function testShouldPassIfInstanceOfRequestIsReturned(): void
    {
        $instance = new KeyValueDeleteRequestModel(request(), '');
        $this->assertInstanceOf(Request::class, $instance->getRequest());
    }
}
