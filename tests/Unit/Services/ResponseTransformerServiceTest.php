<?php

namespace ConsulConfigManager\Consul\KeyValue\Test\Unit\Services;

use ConsulConfigManager\Consul\KeyValue\Test\TestCase;
use ConsulConfigManager\Consul\KeyValue\Services\ResponseTransformerService;

/**
 * Class ResponseTransformerServiceTest
 * @package ConsulConfigManager\Consul\KeyValue\Test\Unit\Services
 */
class ResponseTransformerServiceTest extends TestCase
{
    /**
     * @return void
     */
    public function testShouldPassIfInstanceOfTransformerIsReturned(): void
    {
        $this->assertInstanceOf(ResponseTransformerService::class, $this->service());
    }

    /**
     * @return void
     */
    public function testShouldPassIfInstanceOfTransformerIsReturnedWhenMappingAllKeys(): void
    {
        $service = $this->service();
        $service->mapKeys($this->generalKeysMap());

        $this->assertInstanceOf(ResponseTransformerService::class, $service);
    }

    /**
     * @return void
     */
    public function testShouldPassIfInstanceOfTransformerIsReturnedWhenMappingStartsWithKeys(): void
    {
        $service = $this->service();
        $service->mapKeysStartingWith($this->startsWithKeyMap());

        $this->assertInstanceOf(ResponseTransformerService::class, $service);
    }

    /**
     * @return void
     */
    public function testShouldPassIfInstanceOfTransformerIsReturnedWhenMappingEndsWithKeys(): void
    {
        $service = $this->service();
        $service->mapKeysEndingWith($this->endsWithKeyMap());

        $this->assertInstanceOf(ResponseTransformerService::class, $service);
    }

    /**
     * @return void
     */
    public function testShouldPassIfInstanceOfTransformerIsReturnedWhenMappingContainsKeys(): void
    {
        $service = $this->service();
        $service->mapContains($this->containsKeyMap());

        $this->assertInstanceOf(ResponseTransformerService::class, $service);
    }

    public function testShouldPassIfExpectedRawResponseReturned(): void
    {
        $service = $this->service();
        $response = $service->mapContains($this->containsKeyMap())->getRawResponse();
        $this->assertSame([
            'ID'            =>  'example-id',
            'ServiceName'   =>  'example_service_name',
            'ServiceID'     =>  1,
            'HTTPAddress'   =>  '127.0.0.1',
            'HTTPPort'      =>  80,
        ], $response);
    }

    public function testShouldPassIfExpectedFormattedResponseReturnedWithMap(): void
    {
        $service = $this->service();
        $response = $service->mapKeys($this->containsKeyMap())->getFormattedResponse();
        $this->assertSame([
            'id'                =>  'example-id',
            'service_name'      =>  'example_service_name',
            'service_i_d'       =>  1,
            'h_t_t_p_address'   =>  '127.0.0.1',
            'h_t_t_p_port'      =>  80,
        ], $response);
    }

    public function testShouldPassIfExpectedFormattedResponseReturnedWithStartsWith(): void
    {
        $service = $this->service();
        $response = $service->mapKeysStartingWith($this->startsWithKeyMap())->getFormattedResponse();
        $this->assertSame([
            'id'            =>  'example-id',
            'service_name'  =>  'example_service_name',
            'service_i_d'   =>  1,
            'http_address'  =>  '127.0.0.1',
            'http_port'     =>  80,
        ], $response);
    }

    public function testShouldPassIfExpectedFormattedResponseReturnedWithEndsWith(): void
    {
        $service = $this->service();
        $response = $service->mapKeysEndingWith($this->endsWithKeyMap())->getFormattedResponse();
        $this->assertSame([
            'id'                =>  'example-id',
            'service_name'      =>  'example_service_name',
            'service_id'        =>  1,
            'h_t_t_p_address'   =>  '127.0.0.1',
            'h_t_t_p_port'  =>  80,
        ], $response);
    }

    public function testShouldPassIfExpectedFormattedResponseReturnedWithContains(): void
    {
        $service = $this->service();
        $response = $service->mapContains($this->containsKeyMap())->getFormattedResponse();
        $this->assertSame([
            'id'            =>  'example-id',
            'service_name'  =>  'example_service_name',
            'service_id'    =>  1,
            'http_address'  =>  '127.0.0.1',
            'http_port'     =>  80,
        ], $response);
    }

    /**
     * Create new instance of service
     * @return ResponseTransformerService
     */
    private function service(): ResponseTransformerService
    {
        return new ResponseTransformerService([
            'ID'            =>  'example-id',
            'ServiceName'   =>  'example_service_name',
            'ServiceID'     =>  1,
            'HTTPAddress'   =>  '127.0.0.1',
            'HTTPPort'      =>  80,
        ]);
    }

    /**
     * Example key map array
     * @return string[]
     */
    private function generalKeysMap(): array
    {
        return [
            'ID'        =>  'Id',
            'HTTP'      =>  'Http',
        ];
    }

    /**
     * `startsWith` key map array
     * @return string[]
     */
    private function startsWithKeyMap(): array
    {
        return [
            'ID'        =>  'id',
            'HTTP'      =>  'http',
        ];
    }

    /**
     * `endsWith` key map array
     * @return string[]
     */
    private function endsWithKeyMap(): array
    {
        return [
            'ID'        =>  'Id',
            'HTTP'      =>  'Http',
        ];
    }

    /**
     * `contains` key map array
     * @return string[]
     */
    private function containsKeyMap(): array
    {
        return [
            'ID'        =>  'Id',
            'HTTP'      =>  'Http',
        ];
    }
}
