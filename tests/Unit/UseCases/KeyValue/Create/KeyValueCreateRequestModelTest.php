<?php

namespace ConsulConfigManager\Consul\KeyValue\Test\Unit\UseCases\KeyValue\Create;

use ConsulConfigManager\Consul\KeyValue\Test\TestCase;
use ConsulConfigManager\Consul\KeyValue\Http\Requests\KeyValue\KeyValueCreateUpdateRequest;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Create\KeyValueCreateRequestModel;

/**
 * Class KeyValueCreateRequestModelTest
 * @package ConsulConfigManager\Consul\KeyValue\Test\Unit\UseCases\KeyValue\Create
 */
class KeyValueCreateRequestModelTest extends TestCase
{
    /**
     * @param array $data
     * @dataProvider dataProvider
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromGetRequestMethod(array $data): void
    {
        $model = $this->createRequestModel($data);
        $this->assertInstanceOf(KeyValueCreateUpdateRequest::class, $model->getRequest());
    }

    /**
     * @param array $data
     * @dataProvider dataProvider
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromGetPathMethod(array $data): void
    {
        $model = $this->createRequestModel($data);
        $this->assertSame('example/test', $model->getPath());
    }

    /**
     * @param array $data
     * @dataProvider dataProvider
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromGetValueMethod(array $data): void
    {
        $model = $this->createRequestModel($data);
        $this->assertSame([
            'type'      =>  'string',
            'value'     =>  'Hello World!',
        ], $model->getValue());
    }

    /**
     * Create request instance
     * @param array $data
     * @return KeyValueCreateUpdateRequest
     */
    private function createRequest(array $data): KeyValueCreateUpdateRequest
    {
        return new KeyValueCreateUpdateRequest($data, $data);
    }

    /**
     * Create request model
     * @param array $data
     * @return KeyValueCreateRequestModel
     */
    private function createRequestModel(array $data): KeyValueCreateRequestModel
    {
        return new KeyValueCreateRequestModel(
            $this->createRequest($data)
        );
    }

    /**
     * Data provider
     * @return \array[][]
     */
    public function dataProvider(): array
    {
        return [
            'example_request'           =>  [
                'data'                  =>  [
                    'path'              =>  'example/test',
                    'value'             =>  [
                        'type'          =>  'string',
                        'value'         =>  'Hello World!',
                    ],
                ],
            ],
        ];
    }
}
