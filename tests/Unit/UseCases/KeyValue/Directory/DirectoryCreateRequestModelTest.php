<?php

namespace ConsulConfigManager\Consul\KeyValue\Test\Unit\UseCases\KeyValue\Directory;

use ConsulConfigManager\Consul\KeyValue\Test\TestCase;
use ConsulConfigManager\Consul\KeyValue\Http\Requests\KeyValue\DirectoryCreateRequest;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Directory\DirectoryCreateRequestModel;

/**
 * Class DirectoryCreateRequestModelTest
 * @package ConsulConfigManager\Consul\KeyValue\Test\Unit\UseCases\KeyValue\Directory
 */
class DirectoryCreateRequestModelTest extends TestCase
{
    /**
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromGetRequestMethod(): void
    {
        $request = $this->createRequest(['path' => 'test/directory']);
        $model = new DirectoryCreateRequestModel($request, 'test/directory');
        $this->assertInstanceOf(DirectoryCreateRequest::class, $model->getRequest());
    }

    /**
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromGetPathMethod(): void
    {
        $request = $this->createRequest(['path' => 'test/directory']);
        $model = new DirectoryCreateRequestModel($request, 'test/directory');
        $this->assertSame('test/directory', $model->getPath());
    }

    /**
     * Create request instance
     * @param array $data
     * @return DirectoryCreateRequest
     */
    private function createRequest(array $data): DirectoryCreateRequest
    {
        return new DirectoryCreateRequest($data, $data);
    }
}