<?php

namespace ConsulConfigManager\Consul\KeyValue\Test\Unit\Models;

use Illuminate\Support\Arr;
use ConsulConfigManager\Consul\KeyValue\Test\TestCase;
use ConsulConfigManager\Consul\KeyValue\Models\KeyValue;
use ConsulConfigManager\Consul\KeyValue\Interfaces\KeyValueInterface;
use ConsulConfigManager\Consul\KeyValue\AggregateRoots\KeyValueAggregateRoot;
use ConsulConfigManager\Consul\KeyValue\Interfaces\KeyValueRepositoryInterface;

/**
 * Class KeyValueTest
 * @package ConsulConfigManager\Consul\KeyValue\Test\Unit\Models
 */
class KeyValueTest extends TestCase
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
    public function testShouldPassIfValidDataReturnedFromIsReferenceMethod(array $data): void
    {
        $response = $this->model($data)->isReference();
        $this->assertEquals(false, $response);
    }

    /**
     * @param array $data
     *
     * @dataProvider modelDataProvider
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromMarkAsReferenceMethod(array $data): void
    {
        $model = $this->model($data);
        $model->markAsReference();
        $this->assertEquals(true, $model->isReference());
    }

    /**
     * @param array $data
     *
     * @dataProvider modelDataProvider
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromResolveReferencePathMethod(array $data): void
    {
        $this->repository()->create(
            Arr::get($data, 'path'),
            Arr::get($data, 'value')
        );

        $referenceModel = $this->repository()->create(
            Arr::get($data, 'path') . '_reference',
            [
                'type'      =>  'reference',
                'value'     =>  Arr::get($data, 'path'),
            ]
        );

        $this->assertSame([
            'reference'         =>  Arr::get($data, 'path'),
            'value'             =>  Arr::get($data, 'value'),
        ], $referenceModel->resolveReferencePath([
            'type'      =>  'reference',
            'value'     =>  Arr::get($data, 'path'),
        ]));
    }

    /**
     * @param array $data
     *
     * @dataProvider modelDataProvider
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromResolveNestedReferencePathMethod(array $data): void
    {
        $this->repository()->create(
            Arr::get($data, 'path'),
            Arr::get($data, 'value')
        );

        $this->repository()->create(
            Arr::get($data, 'path') . '_reference',
            [
                'type'      =>  'reference',
                'value'     =>  Arr::get($data, 'path'),
            ]
        );

        $referenceModel = $this->repository()->create(
            Arr::get($data, 'path') . '_reference_reference',
            [
                'type'      =>  'reference',
                'value'     =>  Arr::get($data, 'path') . '_reference',
            ]
        );

        $this->assertSame([
            'reference'         =>  Arr::get($data, 'path') . '_reference_reference',
            'value'             =>  [
                'reference'     =>  Arr::get($data, 'path') . '_reference',
                'value'         =>  [
                    'reference' =>  Arr::get($data, 'path'),
                    'value'     =>  Arr::get($data, 'value'),
                ],
            ],
        ], $referenceModel->resolveReferencePath([
            'type'      =>  'reference',
            'value'     =>  Arr::get($data, 'path') . '_reference_reference',
        ]));
    }

    /**
     * @param array $data
     *
     * @dataProvider modelDataProvider
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromResolveReferenceValueMethodWithoutKey(array $data): void
    {
        $this->repository()->create(
            Arr::get($data, 'path'),
            Arr::get($data, 'value')
        );

        $referenceModel = $this->repository()->create(
            Arr::get($data, 'path') . '_reference',
            [
                'type'      =>  'reference',
                'value'     =>  Arr::get($data, 'path'),
            ]
        );

        $this->assertSame(
            Arr::get($data, 'value'),
            $referenceModel->resolveReferenceValue()
        );
    }

    /**
     * @param array $data
     *
     * @dataProvider modelDataProvider
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromResolveReferenceValueMethodWithKey(array $data): void
    {
        $this->repository()->create(
            Arr::get($data, 'path'),
            Arr::get($data, 'value')
        );

        $referenceModel = $this->repository()->create(
            Arr::get($data, 'path') . '_reference',
            [
                'type'      =>  'reference',
                'value'     =>  Arr::get($data, 'path'),
            ]
        );

        $this->assertSame(
            Arr::get($data, 'value'),
            $referenceModel->resolveReferenceValue(Arr::get($data, 'path'))
        );
    }

    /**
     * @param array $data
     *
     * @dataProvider modelDataProvider
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromResolveNestedReferenceValueMethod(array $data): void
    {
        $this->repository()->create(
            Arr::get($data, 'path'),
            Arr::get($data, 'value')
        );

        $this->repository()->create(
            Arr::get($data, 'path') . '_reference',
            [
                'type'      =>  'reference',
                'value'     =>  Arr::get($data, 'path'),
            ]
        );

        $referenceModel = $this->repository()->create(
            Arr::get($data, 'path') . '_reference_reference',
            [
                'type'      =>  'reference',
                'value'     =>  Arr::get($data, 'path') . '_reference',
            ]
        );

        $this->assertSame(
            Arr::get($data, 'value'),
            $referenceModel->resolveReferenceValue(Arr::get($data, 'path'))
        );
    }

    /**
     * @param array $data
     *
     * @dataProvider modelDataProvider
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromUuidMethod(array $data): void
    {
        KeyValueAggregateRoot::retrieve(Arr::get($data, 'uuid'))
            ->createEntity(Arr::get($data, 'path'), Arr::get($data, 'value'))
            ->persist();
        $modelNoTrashed = KeyValue::uuid(Arr::get($data, 'uuid'));
        $modelTrashed = KeyValue::uuid(Arr::get($data, 'uuid'), true);
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
     * @return KeyValueInterface
     */
    private function model(array $data): KeyValueInterface
    {
        return KeyValue::factory()->make($data);
    }

    /**
     * Create repository instance
     * @return KeyValueRepositoryInterface
     */
    private function repository(): KeyValueRepositoryInterface
    {
        return $this->app->make(KeyValueRepositoryInterface::class);
    }
}
