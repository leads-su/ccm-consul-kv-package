<?php

namespace ConsulConfigManager\Consul\KeyValue\Test\Unit\UseCases\KeyValuePending\Structure;

use ConsulConfigManager\Consul\KeyValue\Test\TestCase;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Structure\KeyValuePendingStructureResponseModel;

/**
 * Class KeyValuePendingStructureResponseModelTest
 * @package ConsulConfigManager\Consul\KeyValue\Test\Unit\UseCases\KeyValuePending\Structure
 */
class KeyValuePendingStructureResponseModelTest extends TestCase
{
    /**
     * @return void
     */
    public function testShouldPassWithArrayPassed(): void
    {
        $data = [];
        $instance = new KeyValuePendingStructureResponseModel($data);
        $this->assertSame([], $instance->getEntities());
    }

    /**
     * @return void
     */
    public function testShouldPassWithNullPassed(): void
    {
        $data = null;
        $instance = new KeyValuePendingStructureResponseModel($data);
        $this->assertSame([], $instance->getEntities());
    }
}
