<?php

namespace ConsulConfigManager\Consul\KeyValue\Test\Unit\Services;

use Consul\Exceptions\RequestException;
use Mockery;
use Consul\Services\KeyValue\KeyValue;
use ConsulConfigManager\Consul\KeyValue\Test\TestCase;
use ConsulConfigManager\Consul\KeyValue\Services\KeyValueService;

/**
 * Class KeyValueServiceDirectoryTest
 * @package ConsulConfigManager\Consul\KeyValue\Test\Unit\Services
 */
class KeyValueServiceDirectoryTest extends TestCase
{
    /**
     * @var KeyValueService
     */
    private KeyValueService $service;

    /**
     * @var Mockery\MockInterface|KeyValue
     */
    private $consulService;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->consulService = Mockery::mock(KeyValue::class);
        $this->service = new KeyValueService();

        $reflection = new \ReflectionClass($this->service);
        $property = $reflection->getProperty('service');
        $property->setAccessible(true);
        $property->setValue($this->service, $this->consulService);
    }

    /**
     * @return void
     */
    public function testCreateDirectoryShouldReturnTrue(): void
    {
        $path = 'test/directory';
        $normalizedPath = 'test/directory/';
        $metaValue = ['created_at' => now()->format('Y-m-d')];

        $this->consulService
            ->shouldReceive('put')
            ->once()
            ->with($normalizedPath, null)
            ->andReturn(true);

        $this->consulService
            ->shouldReceive('get')
            ->once()
            ->with(
                sprintf('%s__ccm_system', $normalizedPath),
                [0 => 'raw']
            )
            ->andThrow(RequestException::class);

        $this->consulService
            ->shouldReceive('put')
            ->once()
            ->with(
                sprintf('%s__ccm_system', $normalizedPath),
                json_encode($metaValue, JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
            )
            ->andReturn(true);

        $result = $this->service->createDirectory($path);

        $this->assertTrue($result);
    }

    /**
     * @return void
     */
    public function testCreateDirectoryWithTrailingSlashShouldNormalizePath(): void
    {
        $path = 'test/directory/';
        $normalizedPath = 'test/directory/';
        $metaValue = ['created_at' => now()->format('Y-m-d')];

        $this->consulService
            ->shouldReceive('put')
            ->once()
            ->with($normalizedPath, null)
            ->andReturn(true);

        $this->consulService
            ->shouldReceive('get')
            ->once()
            ->with(
                sprintf('%s__ccm_system', $normalizedPath),
                [0 => 'raw']
            )
            ->andThrow(RequestException::class);

        $this->consulService
            ->shouldReceive('put')
            ->once()
            ->with(
                sprintf('%s__ccm_system', $normalizedPath),
                json_encode($metaValue, JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
            )
            ->andReturn(true);

        $result = $this->service->createDirectory($path);

        $this->assertTrue($result);
    }

    /**
     * @return void
     */
    public function testDeleteDirectoryRecursiveShouldReturnTrue(): void
    {
        $path = 'test/directory';
        $prefixPath = 'test/directory';
        $normalizedPath = 'test/directory/';
        $keys = ['test/directory/key1', 'test/directory/key2'];

        $this->consulService
            ->shouldReceive('get')
            ->once()
            ->with($prefixPath, ['keys' => true])
            ->andReturn($keys);

        $this->consulService
            ->shouldReceive('delete')
            ->once()
            ->with('test/directory/key1')
            ->andReturn(true);

        $this->consulService
            ->shouldReceive('delete')
            ->once()
            ->with('test/directory/key2')
            ->andReturn(true);

        $this->consulService
            ->shouldReceive('delete')
            ->once()
            ->with($prefixPath, ['recurse' => true])
            ->andReturn(true);

        $this->consulService
            ->shouldReceive('delete')
            ->once()
            ->with($normalizedPath, ['recurse' => true])
            ->andReturn(true);

        $result = $this->service->deleteDirectory($path, true);

        $this->assertTrue($result);
    }

    /**
     * @return void
     */
    public function testDeleteDirectoryNonRecursiveShouldReturnTrue(): void
    {
        $path = 'test/directory';
        $normalizedPath = 'test/directory/';

        $this->consulService
            ->shouldReceive('delete')
            ->once()
            ->with($normalizedPath)
            ->andReturn(true);

        $result = $this->service->deleteDirectory($path, false);

        $this->assertTrue($result);
    }

    /**
     * @return void
     */
    public function testListDirectoryKeysShouldReturnArray(): void
    {
        $path = 'test/directory';
        $normalizedPath = 'test/directory/';
        $expectedKeys = ['test/directory/key1', 'test/directory/key2'];

        $this->consulService
            ->shouldReceive('get')
            ->once()
            ->with($normalizedPath, ['keys' => true])
            ->andReturn($expectedKeys);

        $result = $this->service->listDirectoryKeys($path);

        $this->assertEquals($expectedKeys, $result);
    }

    /**
     * @return void
     */
    public function testGetDirectoryContentsShouldReturnDecodedValues(): void
    {
        $path = 'test/directory';
        $normalizedPath = 'test/directory/';

        $consulResponse = [
            [
                'Key' => 'test/directory/key1',
                'Value' => base64_encode(json_encode(['data' => 'value1'])),
            ],
            [
                'Key' => 'test/directory/key2',
                'Value' => base64_encode('plain text value'),
            ],
            [
                'Key' => 'test/directory/key3',
                'Value' => null,
            ],
        ];

        $expectedResult = [
            'test/directory/key1' => ['data' => 'value1'],
            'test/directory/key2' => 'plain text value',
            'test/directory/key3' => null,
        ];

        $this->consulService
            ->shouldReceive('get')
            ->once()
            ->with($normalizedPath, ['recurse' => true])
            ->andReturn($consulResponse);

        $result = $this->service->getDirectoryContents($path);

        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @return void
     */
    public function testGetDirectoryContentsWithMalformedJsonShouldKeepOriginalValue(): void
    {
        $path = 'test/directory';
        $normalizedPath = 'test/directory/';

        $consulResponse = [
            [
                'Key' => 'test/directory/key1',
                'Value' => base64_encode('invalid json {'),
            ],
        ];

        $expectedResult = [
            'test/directory/key1' => 'invalid json {',
        ];

        $this->consulService
            ->shouldReceive('get')
            ->once()
            ->with($normalizedPath, ['recurse' => true])
            ->andReturn($consulResponse);

        $result = $this->service->getDirectoryContents($path);

        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @return void
     */
    public function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
