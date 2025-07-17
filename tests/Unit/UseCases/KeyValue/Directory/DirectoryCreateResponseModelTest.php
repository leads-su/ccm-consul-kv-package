<?php

namespace ConsulConfigManager\Consul\KeyValue\Test\Unit\UseCases\KeyValue\Directory;

use ConsulConfigManager\Consul\KeyValue\Test\TestCase;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Directory\DirectoryCreateResponseModel;

/**
 * Class DirectoryCreateResponseModelTest
 * @package ConsulConfigManager\Consul\KeyValue\Test\Unit\UseCases\KeyValue\Directory
 */
class DirectoryCreateResponseModelTest extends TestCase
{
    /**
     * @return void
     */
    public function testShouldPassIfSuccessfulResponseCreated(): void
    {
        $model = new DirectoryCreateResponseModel(true);
        $this->assertTrue($model->getResult());
    }

    /**
     * @return void
     */
    public function testShouldPassIfFailedResponseCreated(): void
    {
        $model = new DirectoryCreateResponseModel(false);
        $this->assertFalse($model->getResult());
    }
}
