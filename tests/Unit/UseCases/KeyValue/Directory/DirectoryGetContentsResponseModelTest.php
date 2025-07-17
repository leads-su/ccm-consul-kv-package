<?php

namespace ConsulConfigManager\Consul\KeyValue\Test\Unit\UseCases\KeyValue\Directory;

use ConsulConfigManager\Consul\KeyValue\Test\TestCase;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Directory\DirectoryGetContentsResponseModel;

/**
 * Class DirectoryGetContentsResponseModelTest
 * @package ConsulConfigManager\Consul\KeyValue\Test\Unit\UseCases\KeyValue\Directory
 */
class DirectoryGetContentsResponseModelTest extends TestCase
{
    /**
     * @return void
     */
    public function testShouldPassIfSuccessfulResponseCreated(): void
    {
        $contents = ['test/directory/key1' => 'value1', 'test/directory/key2' => 'value2'];
        $model = new DirectoryGetContentsResponseModel($contents);
        $this->assertSame($contents, $model->getContents());
    }

    /**
     * @return void
     */
    public function testShouldPassIfFailedResponseCreated(): void
    {
        $model = new DirectoryGetContentsResponseModel([]);
        $this->assertSame([], $model->getContents());
    }
}
