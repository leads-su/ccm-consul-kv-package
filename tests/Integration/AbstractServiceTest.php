<?php

namespace ConsulConfigManager\Consul\KeyValue\Test\Integration;

use ConsulConfigManager\Consul\KeyValue\Test\TestCase;
use ConsulConfigManager\Consul\KeyValue\Services\AbstractService;

/**
 * Class AbstractServiceTest
 * @package ConsulConfigManager\Consul\KeyValue\Test\Integration
 */
abstract class AbstractServiceTest extends TestCase
{
    /**
     * Class we are currently testing
     * @var AbstractService
     */
    private AbstractService $testedClass;

    /**
     * @inheritDoc
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->testedClass = new class () extends AbstractService {
            public function clientInstance()
            {
                return $this->client();
            }
        };
    }

    public function testShouldPassIfSpecifiedServiceIsOnline(): void
    {
        $response = $this->testedClass->serverOnline(
            config('consul.kv.connections.default.host'),
            config('consul.kv.connections.default.port'),
        );
        $this->assertTrue($response);
    }

    public function testShouldPassIfSpecifiedServerIsOffline(): void
    {
        $response = $this->testedClass->serverOnline(
            config('consul.kv.connections.default.host'),
            1234,
        );
        $this->assertFalse($response);
    }
}
