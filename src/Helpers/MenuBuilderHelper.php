<?php

namespace ConsulConfigManager\Consul\KeyValue\Helpers;

use ConsulConfigManager\Consul\KeyValue\Interfaces\KeyValueRepositoryInterface;

/**
 * Class MenuBuilderHelper
 * @package ConsulConfigManager\Consul\KeyValue\Helpers
 */
class MenuBuilderHelper
{
    /**
     * Generate key value tree for menu
     * @param KeyValueRepositoryInterface $repository
     * @return array
     */
    public static function keyValueTree(KeyValueRepositoryInterface $repository): array
    {
        $keys = $repository->allKeys();
        $tree = [];

        $globalIndex = 1;
        foreach ($keys as $key) {
            $keyParts = explode('/', $key);
            $reference = &$tree;
            $keyPath = '';
            foreach ($keyParts as $index => $keyPart) {
                $isLast = $index === \count($keyParts) - 1;
                $keyPath .= $keyPart . '/';
                if (array_key_exists($keyPart, $reference)) {
                    $reference = &$reference[$keyPart]['children'];
                } else {
                    if (!$isLast) {
                        $reference[$keyPart] = [
                            'id'        =>  $globalIndex,
                            'name'      =>  $keyPart,
                            'key'       =>  $keyPath,
                            'children'  =>  [],
                        ];
                        $reference = &$reference[$keyPart]['children'];
                    } else {
                        $reference[$keyPart] = [
                            'id'        =>  $globalIndex,
                            'name'      =>  $keyPart,
                            'key'       =>  rtrim($keyPath, '/'),
                        ];
                        $reference = &$reference[$keyPart];
                    }
                    $globalIndex++;
                }
            }
        }

        return self::keyValueTreeToArray($tree);
    }

    /**
     * Convert generated key value tree to valid array
     * @param array $sourceArray
     * @return array
     */
    private static function keyValueTreeToArray(array $sourceArray): array
    {
        $finalArray = [];
        foreach ($sourceArray as $key => $value) {
            if (is_array($value)) {
                if ($key !== 'children') {
                    $finalArray[] = static::keyValueTreeToArray($value);
                } else {
                    $finalArray['children'] = static::keyValueTreeToArray($value);
                }
            } else {
                $finalArray[$key] = $value;
            }
        }
        return $finalArray;
    }
}
