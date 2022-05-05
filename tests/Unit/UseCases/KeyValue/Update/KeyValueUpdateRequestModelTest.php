<?php

namespace ConsulConfigManager\Consul\KeyValue\Test\Unit\UseCases\KeyValue\Update;

use ConsulConfigManager\Consul\KeyValue\Test\TestCase;
use ConsulConfigManager\Consul\KeyValue\Http\Requests\KeyValue\KeyValueCreateUpdateRequest;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Update\KeyValueUpdateRequestModel;

/**
 * Class KeyValueUpdateRequestModelTest
 * @package ConsulConfigManager\Consul\KeyValue\Test\Unit\UseCases\KeyValue\Update
 */
class KeyValueUpdateRequestModelTest extends TestCase
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
     * Update request instance
     * @param array $data
     * @return KeyValueCreateUpdateRequest
     */
    private function createRequest(array $data): KeyValueCreateUpdateRequest
    {
        return new KeyValueCreateUpdateRequest($data, $data);
    }

    /**
     * Update request model
     * @param array $data
     * @return KeyValueUpdateRequestModel
     */
    private function createRequestModel(array $data): KeyValueUpdateRequestModel
    {
        return new KeyValueUpdateRequestModel(
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
