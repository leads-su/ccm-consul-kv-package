<?php

namespace ConsulConfigManager\Consul\KeyValue\Test\Unit\UseCases\KeyValue\Directory;

use ConsulConfigManager\Consul\KeyValue\Test\TestCase;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Directory\DirectoryGetContentsRequestModel;

/**
 * Class DirectoryGetContentsRequestModelTest
 * @package ConsulConfigManager\Consul\KeyValue\Test\Unit\UseCases\KeyValue\Directory
 */
class DirectoryGetContentsRequestModelTest extends TestCase
{
    /**
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromGetRequestMethod(): void
    {
        $request = new \Illuminate\Http\Request();
        $model = new DirectoryGetContentsRequestModel($request, 'test/directory');
        $this->assertInstanceOf(\Illuminate\Http\Request::class, $model->getRequest());
    }

    /**
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromGetPathMethod(): void
    {
        $request = new \Illuminate\Http\Request();
        $model = new DirectoryGetContentsRequestModel($request, 'test/directory');
        $this->assertSame('test/directory', $model->getPath());
    }
}