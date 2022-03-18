<?php

namespace ConsulConfigManager\Consul\KeyValue\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use ConsulConfigManager\Consul\KeyValue\Factories\KeyValuePendingFactory;
use ConsulConfigManager\Consul\KeyValue\Interfaces\KeyValuePendingInterface;

/**
 * Class KeyValuePending
 * @package ConsulConfigManager\Consul\KeyValue\Models
 */
class KeyValuePending extends Model implements KeyValuePendingInterface
{
    use HasFactory;

    /**
     * @inheritDoc
     */
    public $table = 'consul_pending_key_values';

    /**
     * @inheritDoc
     */
    protected $fillable = [
        'uuid',
        'path',
        'value',
        'created_at',
        'updated_at',
    ];

    /**
     * @inheritDoc
     */
    protected $guarded = [];

    /**
     * @inheritDoc
     */
    protected $hidden = [];

    /**
     * @inheritDoc
     */
    protected $casts = [
        'id'            =>  'integer',
        'uuid'          =>  'string',
        'path'          =>  'string',
        'value'         =>  'array',
    ];

    /**
     * @inheritDoc
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * @inheritDoc
     */
    protected $with = [

    ];

    /**
     * @inheritDoc
     */
    public static function uuid(string $uuid): KeyValuePendingInterface|null
    {
        return static::where('uuid', '=', $uuid)->first();
    }

    /**
     * @inheritDoc
     */
    protected static function newFactory(): Factory
    {
        return KeyValuePendingFactory::new();
    }

    /**
     * @inheritDoc
     */
    public function getID(): int
    {
        return (int) $this->attributes['id'];
    }

    /**
     * @inheritDoc
     */
    public function setID(int $id): KeyValuePendingInterface
    {
        $this->attributes['id'] = (int) $id;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getUuid(): string
    {
        return (string) $this->attributes['uuid'];
    }

    /**
     * @inheritDoc
     */
    public function setUuid(string $uuid): KeyValuePendingInterface
    {
        $this->attributes['uuid'] = (string) $uuid;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getPath(): string
    {
        return (string) $this->attributes['path'];
    }

    /**
     * @inheritDoc
     */
    public function setPath(string $path): KeyValuePendingInterface
    {
        $this->attributes['path'] = (string) $path;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getValue(): array
    {
        return (array) json_decode($this->attributes['value'], true);
    }

    /**
     * @inheritDoc
     */
    public function setValue(array $value): KeyValuePendingInterface
    {
        $this->attributes['value'] = json_encode($value);
        return $this;
    }
}
