<?php

namespace ConsulConfigManager\Consul\KeyValue\Test\Unit\Repositories;

use Illuminate\Support\Arr;
use ConsulConfigManager\Consul\KeyValue\Models\KeyValue;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use ConsulConfigManager\Consul\KeyValue\Interfaces\KeyValueRepositoryInterface;

/**
 * Class KeyValueRepositoryTest
 * @package ConsulConfigManager\Consul\KeyValue\Test\Unit\Repositories
 */
class KeyValueRepositoryTest extends AbstractRepositoryTest
{
    /**
     * @param array $data
     * @dataProvider entityDataProvider
     * @return void
     */
    public function testShouldPassIfCanCreateNewEntry(array $data): void
    {
        $entity = $this->repository()->create(Arr::get($data, 'path'), Arr::get($data, 'value'));
        $this->assertSameReturned($entity, $data);
    }

    /**
     * @param array $data
     * @dataProvider entityDataProvider
     * @return void
     */
    public function testShouldPassIfCanUpdateExistingEntry(array $data): void
    {
        $entity = $this->repository()->create(Arr::get($data, 'path'), Arr::get($data, 'value'));
        $this->assertSameReturned($entity, $data);

        Arr::set($data, 'value.value', 'Hello New World!');
        $entity = $this->repository()->update(Arr::get($data, 'path'), Arr::get($data, 'value'));
        $this->assertSameReturned($entity, $data);
    }

    /**
     * @param array $data
     * @dataProvider entityDataProvider
     * @return void
     */
    public function testShouldPassIfCanDeleteExistingEntry(array $data): void
    {
        $entity = $this->repository()->create(Arr::get($data, 'path'), Arr::get($data, 'value'));
        $this->assertSameReturned($entity, $data);

        $response = $this->repository()->delete(Arr::get($data, 'path'));
        $this->assertTrue($response);
    }

    /**
     * @param array $data
     * @dataProvider entityDataProvider
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromAllRequest(array $data): void
    {
        $entity = $this->repository()->create(Arr::get($data, 'path'), Arr::get($data, 'value'));
        $this->assertSameReturned($entity, $data);

        $response = $this->repository()->all();
        $this->assertSameReturned($response->first(), $data);
    }

    /**
     * @param array $data
     * @dataProvider entityDataProvider
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromAllKeysRequest(array $data): void
    {
        $entity = $this->repository()->create(Arr::get($data, 'path'), Arr::get($data, 'value'));
        $this->assertSameReturned($entity, $data);

        $response = $this->repository()->allKeys();
        $this->assertEquals([
            Arr::get($data, 'path'),
        ], $response);
    }

    /**
     * @param array $data
     * @dataProvider entityDataProvider
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromAllNamespacedRequest(array $data): void
    {
        $entity = $this->repository()->create(Arr::get($data, 'path'), Arr::get($data, 'value'));
        $this->assertSameReturned($entity, $data);

        [$key, $value] = explode('/', Arr::get($data, 'path'));

        $response = $this->repository()->allNamespaced();
        $this->assertEquals([
            $key    =>  [
                Arr::get($data, 'path'),
            ],
        ], $response);
    }

    /**
     * @param array $data
     * @dataProvider entityDataProvider
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromFindRequest(array $data): void
    {
        $entity = $this->repository()->create(Arr::get($data, 'path'), Arr::get($data, 'value'));
        $this->assertSameReturned($entity, $data);

        $response = $this->repository()->find(Arr::get($data, 'path'));
        $this->assertSameReturned($response, $data);
    }

    /**
     * @param array $data
     * @dataProvider entityDataProvider
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromFindOrFailRequest(array $data): void
    {
        $entity = $this->repository()->create(Arr::get($data, 'path'), Arr::get($data, 'value'));
        $this->assertSameReturned($entity, $data);

        $response = $this->repository()->findOrFail(Arr::get($data, 'path'));
        $this->assertSameReturned($response, $data);
    }

    /**
     * @param array $data
     * @dataProvider entityDataProvider
     * @return void
     */
    public function testShouldPassIfExceptionIsThrownOnModelNotFoundFromFindOrFailRequest(array $data): void
    {
        $this->expectException(ModelNotFoundException::class);
        $this->repository()->findOrFail(Arr::get($data, 'path'));
    }

    /**
     * Create new repository instance
     * @return KeyValueRepositoryInterface
     */
    private function repository(): KeyValueRepositoryInterface
    {
        return $this->app->make(KeyValueRepositoryInterface::class);
    }

    /**
     * Assert that data returned is the same as in array
     * @param KeyValue $entity
     * @param array $data
     * @return void
     */
    private function assertSameReturned(KeyValue $entity, array $data)
    {
        $this->assertInstanceOf(KeyValue::class, $entity);
        $this->assertArrayHasKey('id', $entity);
        $this->assertArrayHasKey('uuid', $entity);
        $this->assertSame(Arr::get($data, 'path'), $entity->getPath());
        $this->assertSame(Arr::get($data, 'value'), $entity->getValue());
    }

    /**
     * Entity data provider
     * @return \array[][]
     */
    public function entityDataProvider(): array
    {
        return [
            'consul/example'        =>  [
                'data'              =>  [
                    'path'          =>  'consul/example',
                    'value'         =>  [
                        'type'      =>  'string',
                        'value'     =>  'Hello World!',
                    ],
                ],
            ],
        ];
    }
}
