<?php

namespace ConsulConfigManager\Consul\KeyValue\Test\Unit\UseCases\KeyValuePending\List;

use ConsulConfigManager\Consul\KeyValue\Test\TestCase;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\List\KeyValuePendingListResponseModel;

/**
 * Class KeyValuePendingListResponseModelTest
 * @package ConsulConfigManager\Consul\KeyValue\Test\Unit\UseCases\KeyValuePending\List
 */
class KeyValuePendingListResponseModelTest extends TestCase
{
    /**
     * @return void
     */
    public function testShouldPassWithArrayPassed(): void
    {
        $data = [];
        $instance = new KeyValuePendingListResponseModel($data);
        $this->assertSame([], $instance->getEntities());
    }
}
