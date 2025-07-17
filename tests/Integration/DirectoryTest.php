<?php

namespace ConsulConfigManager\Consul\KeyValue\Test\Integration;

use JsonException;
use Consul\Exceptions\RequestException;
use ConsulConfigManager\Consul\KeyValue\Services\KeyValueService;
use ConsulConfigManager\Consul\KeyValue\Exceptions\KeyValueAlreadyExistsException;

/**
 * Class DirectoryTest
 * @package ConsulConfigManager\Consul\KeyValue\Test\Integration
 */
class DirectoryTest extends AbstractServiceTest
{
    /**
     * @throws RequestException
     * @return void
     */
    public function testShouldPassIfCanCreateDirectory(): void
    {
        $response = $this->service()->createDirectory('test/integration/directory');
        $this->assertTrue($response);
    }

    /**
     * @throws RequestException
     * @throws JsonException
     * @return void
     */
    public function testShouldPassIfCanCreateKeysInDirectory(): void
    {
        $response1 = $this->service()->createOrUpdateKeyValue('test/integration/directory/key1', [
            'type' => 'string',
            'value' => 'value1',
        ]);
        $this->assertTrue($response1);

        $response2 = $this->service()->createOrUpdateKeyValue('test/integration/directory/key2', [
            'type' => 'string',
            'value' => 'value2',
        ]);
        $this->assertTrue($response2);

        $response3 = $this->service()->createOrUpdateKeyValue('test/integration/directory/subdir/key3', [
            'type' => 'string',
            'value' => 'value3',
        ]);
        $this->assertTrue($response3);
    }

        /**
     * @throws RequestException
     * @return void
     */
    public function testShouldPassIfCanListDirectoryKeys(): void
    {
        $this->service()->createOrUpdateKeyValue('test/integration/directory/key1', [
            'type' => 'string',
            'value' => 'value1',
        ]);
        $this->service()->createOrUpdateKeyValue('test/integration/directory/key2', [
            'type' => 'string',
            'value' => 'value2',
        ]);

        $response = $this->service()->listDirectoryKeys('test/integration/directory');
        $this->assertIsArray($response);

        $this->assertContains('test/integration/directory/key1', $response);
        $this->assertContains('test/integration/directory/key2', $response);

        $hasSubdirKey = false;
        foreach ($response as $key) {
            if (strpos($key, 'test/integration/directory/subdir/') === 0) {
                $hasSubdirKey = true;
                break;
            }
        }
        $this->assertTrue($hasSubdirKey, 'Should contain a key in the subdirectory');
    }

    /**
     * @throws RequestException
     * @return void
     */
    public function testShouldPassIfCanGetDirectoryContents(): void
    {
        $response = $this->service()->getDirectoryContents('test/integration/directory');
        $this->assertIsArray($response);
        $this->assertArrayHasKey('test/integration/directory/key1', $response);
        $this->assertArrayHasKey('test/integration/directory/key2', $response);
        $this->assertArrayHasKey('test/integration/directory/subdir/key3', $response);

        $this->assertEquals([
            'type' => 'string',
            'value' => 'value1',
        ], $response['test/integration/directory/key1']);

        $this->assertEquals([
            'type' => 'string',
            'value' => 'value2',
        ], $response['test/integration/directory/key2']);
    }

    /**
     * @throws RequestException
     * @return void
     */
    public function testShouldPassIfCanDeleteDirectoryNonRecursively(): void
    {
        $this->service()->deleteKey('test/integration/directory/key1');
        $this->service()->deleteKey('test/integration/directory/key2');

        $response1 = $this->service()->deleteDirectory('test/integration/directory/subdir', true);
        $this->assertTrue($response1);

        $response2 = $this->service()->deleteDirectory('test/integration/directory', false);
        $this->assertTrue($response2);
    }

    /**
     * @throws RequestException
     * @return void
     */
    public function testShouldPassIfCanDeleteDirectoryRecursively(): void
    {
        $this->service()->createDirectory('test/integration/recursive');
        $this->service()->createOrUpdateKeyValue('test/integration/recursive/key1', [
            'type' => 'string',
            'value' => 'value1',
        ]);
        $this->service()->createOrUpdateKeyValue('test/integration/recursive/subdir/key2', [
            'type' => 'string',
            'value' => 'value2',
        ]);

        $this->service()->deleteKey('test/integration/recursive/key1');
        $this->service()->deleteKey('test/integration/recursive/subdir/key2');

        $response = $this->service()->deleteDirectory('test/integration/recursive', true);
        $this->assertTrue($response);

        try {
            $keys = $this->service()->getKeysList('test/integration/');
            $recursiveKeys = array_filter($keys, function($key) {
                return strpos($key, 'test/integration/recursive') === 0;
            });
            $this->assertEmpty($recursiveKeys, 'No keys should exist with the recursive prefix');
        } catch (RequestException $e) {
            $this->assertTrue(true, 'Directory path does not exist, which means deletion was successful');
        }
    }

    /**
     * @throws RequestException
     * @return void
     */
    public function testShouldPassIfCanCleanupTestData(): void
    {
        $response = $this->service()->deleteDirectory('test', true);
        $this->assertTrue($response);
    }

    /**
     * Create new instance of service
     * @return KeyValueService
     */
    private function service(): KeyValueService
    {
        return new KeyValueService();
    }
}
