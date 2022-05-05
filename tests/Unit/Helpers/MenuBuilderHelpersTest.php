<?php

namespace ConsulConfigManager\Consul\KeyValue\Test\Unit\Helpers;

use ConsulConfigManager\Consul\KeyValue\Test\TestCase;
use ConsulConfigManager\Consul\KeyValue\Helpers\MenuBuilderHelper;

/**
 * Class MenuBuilderHelpersTest
 * @package ConsulConfigManager\Consul\KeyValue\Test\Unit\Helpers
 */
class MenuBuilderHelpersTest extends TestCase
{
    public function testShouldPassIfValidDataReturnedFromMenuGenerator(): void
    {
        $keys = [
            'basedirectory/key',
            'basedirectory/subdirectory/key1',
            'basedirectory/subdirectory/key2',
        ];
        $result = MenuBuilderHelper::keyValueTree($keys);
        $this->assertSame([
            [
                'id'                    =>  1,
                'name'                  =>  'basedirectory',
                'key'                   =>  'basedirectory/',
                'children'              =>  [
                    [
                        'id'            =>  2,
                        'name'          =>  'key',
                        'key'           =>  'basedirectory/key',
                    ],
                    [
                        'id'            =>  3,
                        'name'          =>  'subdirectory',
                        'key'           =>  'basedirectory/subdirectory/',
                        'children'      =>  [
                            [
                                'id'            =>  4,
                                'name'          =>  'key1',
                                'key'           =>  'basedirectory/subdirectory/key1',
                            ],
                            [
                                'id'            =>  5,
                                'name'          =>  'key2',
                                'key'           =>  'basedirectory/subdirectory/key2',
                            ],
                        ],
                    ],
                ],
            ],
        ], $result);
    }
}
