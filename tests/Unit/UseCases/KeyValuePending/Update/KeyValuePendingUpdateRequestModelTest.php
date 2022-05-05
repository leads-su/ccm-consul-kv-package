<?php

namespace ConsulConfigManager\Consul\KeyValue\Test\Unit\UseCases\KeyValuePending\Update;

use ConsulConfigManager\Consul\KeyValue\Test\TestCase;
use ConsulConfigManager\Consul\KeyValue\Http\Requests\KeyValuePending\KeyValuePendingCreateUpdateRequest;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Update\KeyValuePendingUpdateRequestModel;

/**
 * Class KeyValuePendingUpdateRequestModelTest
 * @package ConsulConfigManager\Consul\KeyValue\Test\Unit\UseCases\KeyValuePending\Update
 */
class KeyValuePendingUpdateRequestModelTest extends TestCase
{
    /**
     * @param array $data
     * @dataProvider dataProvider
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromGetRequestMethod(array $data): void
    {
        $model = $this->createRequestModel($data);
        $this->assertInstanceOf(KeyValuePendingCreateUpdateRequest::class, $model->getRequest());
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
     * @return KeyValuePendingCreateUpdateRequest
     */
    private function createRequest(array $data): KeyValuePendingCreateUpdateRequest
    {
        return new KeyValuePendingCreateUpdateRequest($data, $data);
    }

    /**
     * Update request model
     * @param array $data
     * @return KeyValuePendingUpdateRequestModel
     */
    private function createRequestModel(array $data): KeyValuePendingUpdateRequestModel
    {
        return new KeyValuePendingUpdateRequestModel(
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
