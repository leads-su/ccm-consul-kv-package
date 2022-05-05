<?php

namespace ConsulConfigManager\Consul\KeyValue\Interfaces;

use ArrayAccess;
use JsonSerializable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Contracts\Support\Arrayable;

/**
 * Interface KeyValuePendingInterface
 * @package ConsulConfigManager\Consul\KeyValue\Interfaces
 */
interface KeyValuePendingInterface extends Arrayable, ArrayAccess, Jsonable, JsonSerializable
{
    /**
     * Retrieve model by UUID
     * @param string $uuid
     * @return KeyValuePendingInterface|null
     */
    public static function uuid(string $uuid): KeyValuePendingInterface|null;

    /**
     * Get entity id
     * @return int
     */
    public function getID(): int;

    /**
     * Set entity id
     * @param int $id
     * @return KeyValuePendingInterface
     */
    public function setID(int $id): KeyValuePendingInterface;

    /**
     * Get entity uuid
     * @return string
     */
    public function getUuid(): string;

    /**
     * Set entity uuid
     * @param string $uuid
     * @return KeyValuePendingInterface
     */
    public function setUuid(string $uuid): KeyValuePendingInterface;

    /**
     * Get entity path
     * @return string
     */
    public function getPath(): string;

    /**
     * Set entity path
     * @param string $path
     * @return KeyValuePendingInterface
     */
    public function setPath(string $path): KeyValuePendingInterface;

    /**
     * Get entity value
     * @return array
     */
    public function getValue(): array;

    /**
     * Set entity value
     * @param array $value
     * @return KeyValuePendingInterface
     */
    public function setValue(array $value): KeyValuePendingInterface;
}
