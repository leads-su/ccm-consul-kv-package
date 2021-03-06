<?php

namespace ConsulConfigManager\Consul\KeyValue\Interfaces;

use ArrayAccess;
use JsonSerializable;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Routing\UrlRoutable;
use Illuminate\Contracts\Queue\QueueableEntity;
use Illuminate\Contracts\Broadcasting\HasBroadcastChannel;

/**
 * Interface KeyValueInterface
 * @package ConsulConfigManager\Consul\KeyValue\Interfaces
 */
interface KeyValueInterface extends Arrayable, ArrayAccess, HasBroadcastChannel, Jsonable, JsonSerializable, QueueableEntity, UrlRoutable
{
    /**
     * Retrieve model by UUID
     * @param string $uuid
     * @param bool $withTrashed
     * @return KeyValueInterface|null
     */
    public static function uuid(string $uuid, bool $withTrashed = false): KeyValueInterface|null;

    /**
     * Get entity id
     * @return int
     */
    public function getID(): int;

    /**
     * Set entity id
     * @param int $id
     *
     * @return $this
     */
    public function setID(int $id): self;

    /**
     * Get entity uuid
     * @return string
     */
    public function getUuid(): string;

    /**
     * Set entity uuid
     * @param string $uuid
     *
     * @return $this
     */
    public function setUuid(string $uuid): self;

    /**
     * Get entity path
     * @return string
     */
    public function getPath(): string;

    /**
     * Set entity path
     * @param string $path
     *
     * @return $this
     */
    public function setPath(string $path): self;

    /**
     * Get entity value
     * @return array
     */
    public function getValue(): array;

    /**
     * Set entity value
     * @param array $value
     *
     * @return $this
     */
    public function setValue(array $value): self;

    /**
     * Check if entity is of type of reference
     * @return bool
     */
    public function isReference(): bool;

    /**
     * Mark entity as reference
     *
     * @param bool $isReference
     *
     * @return $this
     */
    public function markAsReference(bool $isReference = true): self;

    /**
     * Create scope which returns only references
     *
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeReferences(Builder $query): Builder;

    /**
     * Get model change history
     * @param string|null $uuid
     *
     * @return Collection
     */
    public function history(?string $uuid = null): Collection;

    /**
     * Resolve reference path
     * @param array $value
     * @return array
     */
    public function resolveReferencePath(array $value): array;

    /**
     * Resolve target value for reference
     * @param string|null $key
     * @return array
     */
    public function resolveReferenceValue(?string $key = null): array;
}
