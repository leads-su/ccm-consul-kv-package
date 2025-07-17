<?php

namespace ConsulConfigManager\Consul\KeyValue\Test\Feature\Http\Controllers\KeyValue\Directory;

use Illuminate\Http\Response;
use ConsulConfigManager\Consul\KeyValue\Test\TestCase;

/**
 * Class DirectoryManagementTest
 * @package ConsulConfigManager\Consul\KeyValue\Test\Feature\Http\Controllers\KeyValue\Directory
 */
class DirectoryManagementTest extends TestCase
{
    /**
     * @return void
     */
    public function testShouldPassIfDirectoryCanBeCreated(): void
    {
        $response = $this->post('/consul/kv/directory', [
            'path' => 'test/directory',
        ]);

        $response->assertStatus(Response::HTTP_CREATED);
        $response->assertJsonStructure([
            'success',
            'code',
            'data',
            'message',
        ]);
    }

    /**
     * @return void
     */
    public function testShouldPassIfDirectoryKeysCanBeListed(): void
    {
        // First create a directory with some content
        $this->post('/consul/kv/directory', [
            'path' => 'test/directory',
        ]);

        $response = $this->get('/consul/kv/directory/test/directory/keys');

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'success',
            'code',
            'data',
            'message',
        ]);
    }

    /**
     * @return void
     */
    public function testShouldPassIfDirectoryContentsCanBeRetrieved(): void
    {
        // First create a directory
        $this->post('/consul/kv/directory', [
            'path' => 'test/directory',
        ]);

        $response = $this->get('/consul/kv/directory/test/directory');

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'success',
            'code',
            'data',
            'message',
        ]);
    }

    /**
     * @return void
     */
    public function testShouldFailIfInvalidPathProvidedForCreation(): void
    {
        $response = $this->post('/consul/kv/directory', [
            'path' => '',
        ]);

        // Accept either 422 (JSON API) or 302 (redirect) as both indicate validation failure
        $this->assertContains($response->status(), [Response::HTTP_UNPROCESSABLE_ENTITY, 302]);

        // Ensure validation error is present
        if ($response->status() === 302) {
            // For redirects, check session errors
            $this->assertTrue($response->getSession()->has('errors'));
        } else {
            // For JSON responses, check response structure
            $response->assertJsonValidationErrors(['path']);
        }
    }

    /**
     * @return void
     */
    public function testShouldFailIfNoPathProvidedForCreation(): void
    {
        $response = $this->post('/consul/kv/directory', []);

        // Accept either 422 (JSON API) or 302 (redirect) as both indicate validation failure
        $this->assertContains($response->status(), [Response::HTTP_UNPROCESSABLE_ENTITY, 302]);

        // Ensure validation error is present
        if ($response->status() === 302) {
            // For redirects, check session errors
            $this->assertTrue($response->getSession()->has('errors'));
        } else {
            // For JSON responses, check response structure
            $response->assertJsonValidationErrors(['path']);
        }
    }

    /**
     * @return void
     */
    public function testShouldPassIfDirectoryPathWithSlashesWorks(): void
    {
        $response = $this->post('/consul/kv/directory', [
            'path' => 'test/nested/deep/directory',
        ]);

        $response->assertStatus(Response::HTTP_CREATED);
    }

}
