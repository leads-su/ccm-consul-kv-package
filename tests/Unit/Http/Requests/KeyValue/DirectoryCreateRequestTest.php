<?php

namespace ConsulConfigManager\Consul\KeyValue\Test\Unit\Http\Requests\KeyValue;

use ConsulConfigManager\Consul\KeyValue\Test\TestCase;
use ConsulConfigManager\Consul\KeyValue\Http\Requests\KeyValue\DirectoryCreateRequest;

/**
 * Class DirectoryCreateRequestTest
 * @package ConsulConfigManager\Consul\KeyValue\Test\Unit\Http\Requests\KeyValue
 */
class DirectoryCreateRequestTest extends TestCase
{
    /**
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromAuthorizeMethod(): void
    {
        $request = new DirectoryCreateRequest();
        $this->assertTrue($request->authorize());
    }

    /**
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromRulesMethod(): void
    {
        $request = new DirectoryCreateRequest();
        $rules = $request->rules();

        $this->assertIsArray($rules);
        $this->assertArrayHasKey('path', $rules);
        $this->assertContains('required', $rules['path']);
        $this->assertContains('string', $rules['path']);
    }

        /**
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromInputMethod(): void
    {
        $request = new DirectoryCreateRequest([
            'path' => 'test/directory',
        ]);

        $this->assertEquals('test/directory', $request->input('path'));
    }

    /**
     * @return void
     */
    public function testShouldPassIfPathValidationWorks(): void
    {
        $request = new DirectoryCreateRequest();
        $rules = $request->rules();

        $pathRules = $rules['path'];
        $hasRegexRule = false;

        foreach ($pathRules as $rule) {
            if (is_string($rule) && strpos($rule, 'regex:') === 0) {
                $hasRegexRule = true;
                break;
            }
        }

        $this->assertTrue($hasRegexRule, 'Path should have regex validation rule');
    }
}
