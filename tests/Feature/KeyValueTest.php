<?php

namespace ConsulConfigManager\Consul\KeyValue\Test\Feature;

use Illuminate\Support\Arr;
use Illuminate\Http\Response;
use ConsulConfigManager\Consul\KeyValue\Test\TestCase;
use ConsulConfigManager\Consul\KeyValue\Models\KeyValue;
use ConsulConfigManager\Consul\KeyValue\Interfaces\KeyValueInterface;
use ConsulConfigManager\Consul\KeyValue\AggregateRoots\KeyValueAggregateRoot;

/**
 * Class KeyValueTest
 * @package ConsulConfigManager\Consul\KeyValue\Test\Feature
 */
class KeyValueTest extends TestCase
{
    /**
     * Common kv uuid
     * @var string
     */
    private static string $uuid = '1ead0ce3-1651-446e-9935-e558ad766cae';

    /**
     * @return void
     */
    public function testShouldPassIfEmptyKeyValuesNamespacedListCanBeRetrieved(): void
    {
        $response = $this->get('/consul/kv');
        $response->assertStatus(Response::HTTP_OK);
        $response->assertExactJson([
            'success'       =>  true,
            'code'          =>  Response::HTTP_OK,
            'data'          =>  [],
            'message'       =>  'Successfully fetched namespaced keys',
        ]);
    }

    /**
     * @return void
     */
    public function testShouldPassIfEmptyKeyValuesReferencesListCanBeRetrieved(): void
    {
        $response = $this->get('/consul/kv/references');
        $response->assertStatus(Response::HTTP_OK);
        $response->assertExactJson([
            'success'       =>  true,
            'code'          =>  200,
            'data'          =>  [],
            'message'       =>  'Successfully fetched list of references',
        ]);
    }

    /**
     * @return void
     */
    public function testShouldPassIfNonEmptyKeyValuesNamespacedListCanBeRetrieved(): void
    {
        $this->createAndGetKeyValue();
        $response = $this->get('/consul/kv');
        $response->assertStatus(Response::HTTP_OK);
        $response->assertExactJson([
            'success'           =>  true,
            'code'              =>  Response::HTTP_OK,
            'data'              =>  [
                'example'       =>  [
                    'example/test',
                ],
            ],
            'message'           =>  'Successfully fetched namespaced keys',
        ]);
    }

    /**
     * @return void
     */
    public function testShouldPassIfNonEmptyKeyValuesReferencesListCanBeRetrieved(): void
    {
        $this->createAndGetKeyValue(true);
        $response = $this->get('/consul/kv/references');
        $response->assertStatus(Response::HTTP_OK);
        $response->assertExactJson([
            'success'           =>  true,
            'code'              =>  Response::HTTP_OK,
            'data'              =>  [
                [
                    'description'   =>  'Hello World!',
                    'text'          =>  'example/test',
                    'value'         =>  'example/test',
                ],
            ],
            'message'           =>  'Successfully fetched list of references',
        ]);
    }

    /**
     * @return void
     */
    public function testShouldPassIfKeyValueInformationCanBeRetrieved(): void
    {
        $this->createAndGetKeyValue();
        $response = $this->get('/consul/kv/example/test');
        $response->assertStatus(Response::HTTP_OK);
        $decoded = Arr::except($response->json('data'), [
            'created_at',
            'updated_at',
            'deleted_at',
        ]);
        ksort($decoded);
        $this->assertArrayHasKey('changelog', $decoded);
        unset($decoded['changelog']);
        $this->assertSame([
            'id'        =>  1,
            'path'      =>  'example/test',
            'reference' =>  false,
            'uuid'      =>  self::$uuid,
            'value'     =>  [
                'type'  =>  'string',
                'value' =>  'Hello World!',
            ],
        ], $decoded);
    }

    /**
     * @return void
     */
    public function testShouldPassIfKeyValueInformationCanBeRetrievedWithNoAuth(): void
    {
        $this->setConfigurationValue('app.no_auth', true);
        $this->createAndGetKeyValue();
        $response = $this->get('/consul/kv/example/test');
        $response->assertStatus(Response::HTTP_OK);
        $decoded = Arr::except($response->json('data'), [
            'created_at',
            'updated_at',
            'deleted_at',
        ]);
        ksort($decoded);
        $this->assertArrayHasKey('changelog', $decoded);
        unset($decoded['changelog']);
        $this->assertSame([
            'id'        =>  1,
            'path'      =>  'example/test',
            'reference' =>  false,
            'uuid'      =>  self::$uuid,
            'value'     =>  [
                'type'  =>  'string',
                'value' =>  '********',
            ],
        ], $decoded);
    }

    /**
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromMenuRequest(): void
    {
        $this->createAndGetKeyValue();
        $response = $this->get('/consul/kv/menu');
        $response->assertStatus(Response::HTTP_OK);
        $response->assertExactJson([
            'success'           =>  true,
            'code'              =>  Response::HTTP_OK,
            'data'              =>  [[
                'id'            =>  1,
                'name'          =>  'example',
                'key'           =>  'example/',
                'children'      =>  [[
                    'id'        =>  2,
                    'name'      =>  'test',
                    'key'       =>  'example/test',
                ]],
            ]],
            'message'           =>  'Successfully generated menu for KV Store',
        ]);
    }

    /**
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromStructureRequest(): void
    {
        $this->createAndGetKeyValue();
        $response = $this->get('/consul/kv/structure');
        $response->assertStatus(Response::HTTP_OK);
        $response->assertExactJson([
            'success'           =>  true,
            'code'              =>  Response::HTTP_OK,
            'data'              =>  [
                'example'       =>  [
                    'example/',
                ],
            ],
            'message'           =>  'Successfully generated structure for KV Store',
        ]);
    }

    /**
     * @return void
     */
    public function testShouldPassIfKeyValueInformationCannotBeRetrieved(): void
    {
        $response = $this->get('/consul/kv/example/test2');
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    /**
     * @return void
     */
    public function testShouldPassIfNotFoundReturnedFromUpdateMethodForMissingKeyValuePath(): void
    {
        $response = $this->patch('/consul/kv', [
            'path'          =>  'example/test',
            'value'         =>  [
                'type'      =>  'string',
                'value'     =>  'Hello World!',
            ],
        ]);
        $response->assertStatus(Response::HTTP_NOT_FOUND);
        $response->assertExactJson([
            'success'       =>  false,
            'code'          =>  Response::HTTP_NOT_FOUND,
            'data'          =>  [],
            'message'       =>  'Unable to find requested consul key value',
        ]);
    }

    /**
     * @return void
     */
    public function testShouldPassIfNotFoundReturnedFromDeleteMethodForMissingKeyValuePath(): void
    {
        $response = $this->delete('/consul/kv/example/test');
        $response->assertStatus(Response::HTTP_NOT_FOUND);
        $response->assertExactJson([
            'success'       =>  false,
            'code'          =>  Response::HTTP_NOT_FOUND,
            'data'          =>  [],
            'message'       =>  'Unable to find requested consul key value',
        ]);
    }

    /**
     * @return void
     */
    public function testShouldPassIfCanCreateNewKeyValueWithStringAsValue(): void
    {
        $this->createAndGetTypedKeyValue('string');
    }

    /**
     * @return void
     */
    public function testShouldPassIfCanCreateNewKeyValueWithNumberAsValue(): void
    {
        $this->createAndGetTypedKeyValue('number');
    }

    /**
     * @return void
     */
    public function testShouldPassIfCanCreateNewKeyValueWithArrayAsValue(): void
    {
        $this->createAndGetTypedKeyValue('array');
    }

    /**
     * @return void
     */
    public function testShouldPassIfCanUpdateExistingKeyValue(): void
    {
        $this->createAndGetTypedKeyValue();
        $payload = [
            'path'      =>  'example/test',
            'value'     =>  $this->typedPayload('array'),
        ];

        $response = $this->patch('/consul/kv/', $payload);
        $response->assertStatus(Response::HTTP_OK);
        $responseData = Arr::only($response->json('data'), ['path', 'value']);
        $this->assertSame($payload, $responseData);
    }

    /**
     * @return void
     */
    public function testShouldPassIfCanDeleteExistingKeyValue(): void
    {
        $model = $this->createAndGetTypedKeyValue();
        $response = $this->delete('/consul/kv/' . $model->getPath());
        $response->assertStatus(Response::HTTP_OK);
        $response->assertExactJson([
            'success'       =>  true,
            'code'          =>  Response::HTTP_OK,
            'data'          =>  [],
            'message'       =>  'Successfully deleted consul key value',
        ]);
    }

    /**
     * Create new key value and return its model
     * @param bool $asReference
     * @return KeyValueInterface
     */
    private function createAndGetKeyValue(bool $asReference = false): KeyValueInterface
    {
        KeyValueAggregateRoot::retrieve(self::$uuid)
            ->createEntity('example/test', [
                'type'          =>  'string',
                'value'         =>  'Hello World!',
            ])
            ->persist();
        if ($asReference) {
            $uuid = str_replace('cae', 'bae', self::$uuid);

            KeyValueAggregateRoot::retrieve($uuid)
                ->createEntity('example/test_reference', [
                    'type'          =>  'reference',
                    'value'         =>  'example/test',
                ])
                ->persist();

            return KeyValue::uuid($uuid);
        }
        return KeyValue::uuid(self::$uuid);
    }

    /**
     * Create new key value and return its model
     * @param string $type
     * @return KeyValueInterface
     */
    private function createAndGetTypedKeyValue(string $type = 'string'): KeyValueInterface
    {
        $payload = $this->typedPayload($type);
        $requestData = [
            'path'          =>  'example/test',
            'value'         =>  $payload,
        ];

        $creationResponse = $this->post('/consul/kv', $requestData);
        $creationResponse->assertStatus(Response::HTTP_CREATED);
        $responseData = Arr::only($creationResponse->json('data'), ['path', 'value']);
        $this->assertSame($requestData, $responseData);
        $creationModel = new KeyValue($creationResponse->json('data'));

        $getResponse = $this->get('/consul/kv/' . $creationModel->getPath());
        $getData = Arr::only($getResponse->json('data'), ['path', 'value']);
        $this->assertSame($requestData, $getData);
        $getModel = new KeyValue($getResponse->json('data'));
        $this->assertSame($creationModel->getPath(), $getModel->getPath());
        $this->assertSame($creationModel->getValue(), $getModel->getValue());

        return $getModel;
    }

    /**
     * Create payload based on provided type
     * @param string $type
     * @return mixed
     */
    private function typedPayload(string $type = 'string'): mixed
    {
        return match ($type) {
            'array' => [
                'type' => 'array',
                'value' => [
                    1, 2, 3, 4, 5,
                ],
            ],
            'number' => [
                'type' => 'number',
                'value' => 1,
            ],
            'reference' => [
                'type' => 'reference',
                'value' => 'example/test_reference',
            ],
            default => [
                'type' => 'string',
                'value' => 'Hello World',
            ],
        };
    }
}
