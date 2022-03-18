<?php

namespace ConsulConfigManager\Consul\KeyValue\Test\Unit\Models;

use Illuminate\Support\Arr;
use ConsulConfigManager\Consul\KeyValue\Test\TestCase;
use ConsulConfigManager\Consul\KeyValue\Models\KeyValuePending;
use ConsulConfigManager\Consul\KeyValue\Interfaces\KeyValuePendingInterface;
use ConsulConfigManager\Consul\KeyValue\AggregateRoots\KeyValuePendingAggregateRoot;

/**
 * Class KeyValuePendingTest
 * @package ConsulConfigManager\Consul\KeyValuePending\Test\Unit\Models
 */
class KeyValuePendingTest extends TestCase
{
    /**
     * @param array $data
     *
     * @dataProvider modelDataProvider
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromGetIdMethod(array $data): void
    {
        $response = $this->model($data)->getID();
        $this->assertEquals(Arr::get($data, 'id'), $response);
    }

    /**
     * @param array $data
     *
     * @dataProvider modelDataProvider
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromSetIdMethod(array $data): void
    {
        $model = $this->model($data);
        $model->setID(2);
        $this->assertEquals(2, $model->getID());
    }

    /**
     * @param array $data
     *
     * @dataProvider modelDataProvider
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromGetUuidMethod(array $data): void
    {
        $response = $this->model($data)->getUuid();
        $this->assertEquals(Arr::get($data, 'uuid'), $response);
    }

    /**
     * @param array $data
     *
     * @dataProvider modelDataProvider
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromSetUuidMethod(array $data): void
    {
        $model = $this->model($data);
        $model->setUuid('f972db4f-52de-4bf3-ba00-6343735d4abc');
        $this->assertEquals('f972db4f-52de-4bf3-ba00-6343735d4abc', $model->getUuid());
    }

    /**
     * @param array $data
     *
     * @dataProvider modelDataProvider
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromGetPathMethod(array $data): void
    {
        $response = $this->model($data)->getPath();
        $this->assertEquals(Arr::get($data, 'path'), $response);
    }

    /**
     * @param array $data
     *
     * @dataProvider modelDataProvider
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromSetPathMethod(array $data): void
    {
        $model = $this->model($data);
        $model->setPath('consul/set_path');
        $this->assertEquals('consul/set_path', $model->getPath());
    }

    /**
     * @param array $data
     *
     * @dataProvider modelDataProvider
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromGetValueMethod(array $data): void
    {
        $response = $this->model($data)->getValue();
        $this->assertEquals(Arr::get($data, 'value'), $response);
    }

    /**
     * @param array $data
     *
     * @dataProvider modelDataProvider
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromSetValueMethod(array $data): void
    {
        $model = $this->model($data);
        $model->setValue(['type' => 'string', 'value' => 'string']);
        $this->assertEquals(['type' => 'string', 'value' => 'string'], $model->getValue());
    }

    /**
     * @param array $data
     *
     * @dataProvider modelDataProvider
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromUuidMethod(array $data): void
    {
        KeyValuePendingAggregateRoot::retrieve(Arr::get($data, 'uuid'))
            ->createEntity(Arr::get($data, 'path'), Arr::get($data, 'value'))
            ->persist();
        $modelNoTrashed = KeyValuePending::uuid(Arr::get($data, 'uuid'));
        $modelTrashed = KeyValuePending::uuid(Arr::get($data, 'uuid'), true);
        $this->assertEquals($modelNoTrashed, $modelTrashed);
        $this->assertSame(Arr::get($data, 'uuid'), $modelNoTrashed->getUuid());
        $this->assertSame(Arr::get($data, 'path'), $modelNoTrashed->getPath());
        $this->assertSame(Arr::get($data, 'value'), $modelNoTrashed->getValue());
    }

    /**
     * Created event data provider
     * @return \array[][]
     */
    public function modelDataProvider(): array
    {
        return [
            'consul/example'            =>  [
                'data'                  =>  [
                    'id'                =>  1,
                    'uuid'              =>  'f972db4f-52de-4bf3-ba00-6343735d4efb',
                    'path'              =>  'consul/example',
                    'value'             =>  [
                        'type'          => 'string',
                        'value'         => 'Hello World',
                    ],
                ],
            ],
        ];
    }

    /**
     * Create model instance
     * @param array $data
     * @return KeyValuePendingInterface
     */
    private function model(array $data): KeyValuePendingInterface
    {
        return KeyValuePending::factory()->make($data);
    }
}
