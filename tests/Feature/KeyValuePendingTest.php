<?php

namespace ConsulConfigManager\Consul\KeyValue\Test\Feature;

use Illuminate\Support\Arr;
use Illuminate\Http\Response;
use ConsulConfigManager\Consul\KeyValue\Test\TestCase;
use ConsulConfigManager\Consul\KeyValue\Models\KeyValuePending;
use ConsulConfigManager\Consul\KeyValue\Interfaces\KeyValuePendingInterface;

/**
 * Class KeyValuePendingTest
 * @package ConsulConfigManager\Consul\KeyValue\Test\Feature
 */
class KeyValuePendingTest extends TestCase
{
    /**
     * @return void
     */
    public function testShouldPassIfEmptyKeyValuesNamespacedListCanBeRetrieved(): void
    {
        $response = $this->get('/consul/kv/pending');
        $response->assertStatus(Response::HTTP_OK);
        $response->assertExactJson([
            'success'       =>  true,
            'code'          =>  Response::HTTP_OK,
            'data'          =>  [],
            'message'       =>  'Successfully fetched list of pending consul key values',
        ]);
    }

    /**
     * @return void
     */
    public function testShouldPassIfNotFoundReturnedFromGetMethodForMissingKeyValuePath(): void
    {
        $response = $this->get('/consul/kv/pending/example/test');
        $response->assertStatus(Response::HTTP_NOT_FOUND);
        $response->assertExactJson([
            'success'       =>  false,
            'code'          =>  Response::HTTP_NOT_FOUND,
            'data'          =>  [],
            'message'       =>  'Unable to find requested pending consul key value',
        ]);
    }

    /**
     * @return void
     */
    public function testShouldPassIfNotFoundReturnedFromUpdateMethodForMissingKeyValuePath(): void
    {
        $response = $this->patch('/consul/kv/pending', [
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
            'message'       =>  'Unable to find requested pending consul key value',
        ]);
    }

    /**
     * @return void
     */
    public function testShouldPassIfNotFoundReturnedFromDeleteMethodForMissingKeyValuePath(): void
    {
        $response = $this->delete('/consul/kv/pending/example/test');
        $response->assertStatus(Response::HTTP_NOT_FOUND);
        $response->assertExactJson([
            'success'       =>  false,
            'code'          =>  Response::HTTP_NOT_FOUND,
            'data'          =>  [],
            'message'       =>  'Unable to find requested pending consul key value',
        ]);
    }

    /**
     * @return void
     */
    public function testShouldPassIfCanCreateNewKeyValueWithStringAsValue(): void
    {
        $this->createAndGetKeyValue('string');
    }

    /**
     * @return void
     */
    public function testShouldPassIfCanCreateNewKeyValueWithNumberAsValue(): void
    {
        $this->createAndGetKeyValue('number');
    }

    /**
     * @return void
     */
    public function testShouldPassIfCanCreateNewKeyValueWithArrayAsValue(): void
    {
        $this->createAndGetKeyValue('array');
    }

    /**
     * @return void
     */
    public function testShouldPassIfCanCreateNewKeyValueWithReferenceAsValue(): void
    {
        $this->createAndGetKeyValue('reference');
    }

    /**
     * @return void
     */
    public function testShouldPassIfCanDeleteExistingKeyValue(): void
    {
        $model = $this->createAndGetKeyValue();
        $response = $this->delete('/consul/kv/pending/' . $model->getPath());
        $response->assertStatus(Response::HTTP_OK);
        $response->assertExactJson([
            'success'       =>  true,
            'code'          =>  Response::HTTP_OK,
            'data'          =>  [],
            'message'       =>  'Successfully deleted pending consul key value',
        ]);
    }

    /**
     * @return void
     */
    public function testShouldPassIfCanUpdateExistingKeyValue(): void
    {
        $this->createAndGetKeyValue();
        $payload = [
            'path'      =>  'example/test',
            'value'     =>  $this->typedPayload('array'),
        ];

        $response = $this->patch('/consul/kv/pending/', $payload);
        $response->assertStatus(Response::HTTP_OK);
        $responseData = Arr::only($response->json('data'), ['path', 'value']);
        $this->assertSame($payload, $responseData);
    }

    /**
     * Create new key value and return its model
     * @param string $type
     * @return KeyValuePendingInterface
     */
    private function createAndGetKeyValue(string $type = 'string'): KeyValuePendingInterface
    {
        $payload = $this->typedPayload($type);
        $requestData = [
            'path'          =>  'example/test',
            'value'         =>  $payload,
        ];

        $creationResponse = $this->post('/consul/kv/pending', $requestData);
        $creationResponse->assertStatus(Response::HTTP_CREATED);
        $responseData = Arr::only($creationResponse->json('data'), ['path', 'value']);
        $this->assertSame($requestData, $responseData);
        $creationModel = new KeyValuePending($creationResponse->json('data'));

        $getResponse = $this->get('/consul/kv/pending/' . $creationModel->getPath());
        $getData = Arr::only($getResponse->json('data'), ['path', 'value']);
        $this->assertSame($requestData, $getData);
        $getModel = new KeyValuePending($getResponse->json('data'));
        $this->assertSame($creationModel->getPath(), $getModel->getPath());
        $this->assertSame($creationModel->getValue(), $getModel->getValue());

        return $getModel;
    }

    /**
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromMenuRequest(): void
    {
        $this->createAndGetKeyValue();
        $response = $this->get('/consul/kv/pending/menu');
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
            'message'           =>  'Successfully generated menu for KV Store of pending values',
        ]);
    }

    /**
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromStructureRequest(): void
    {
        $this->createAndGetKeyValue();
        $response = $this->get('/consul/kv/pending/structure');
        $response->assertStatus(Response::HTTP_OK);
        $response->assertExactJson([
            'success'           =>  true,
            'code'              =>  Response::HTTP_OK,
            'data'              =>  [
                'example'       =>  [
                    'example/',
                ],
            ],
            'message'           =>  'Successfully generated structure for KV Store of pending values',
        ]);
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
