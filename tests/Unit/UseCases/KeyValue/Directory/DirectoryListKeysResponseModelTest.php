<?php

namespace ConsulConfigManager\Consul\KeyValue\Test\Unit\UseCases\KeyValue\Directory;

use ConsulConfigManager\Consul\KeyValue\Test\TestCase;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Directory\DirectoryListKeysResponseModel;

/**
 * Class DirectoryListKeysResponseModelTest
 * @package ConsulConfigManager\Consul\KeyValue\Test\Unit\UseCases\KeyValue\Directory
 */
class DirectoryListKeysResponseModelTest extends TestCase
{
    /**
     * @return void
     */
    public function testShouldPassIfSuccessfulResponseCreated(): void
    {
        $keys = ['test/directory/key1', 'test/directory/key2'];
        $model = new DirectoryListKeysResponseModel($keys);
        $this->assertSame($keys, $model->getKeys());
    }

    /**
     * @return void
     */
    public function testShouldPassIfFailedResponseCreated(): void
    {
        $model = new DirectoryListKeysResponseModel([]);
        $this->assertSame([], $model->getKeys());
    }
}
