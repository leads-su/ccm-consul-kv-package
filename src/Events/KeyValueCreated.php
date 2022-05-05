<?php

namespace ConsulConfigManager\Consul\KeyValue\Events;

use Illuminate\Support\Arr;
use ConsulConfigManager\Users\Interfaces\UserInterface;

/**
 * Class KeyValueCreated
 * @package ConsulConfigManager\Consul\KeyValue\Events
 */
class KeyValueCreated extends AbstractEvent
{
    /**
     * Key path
     * @var string
     */
    private string $path;

    /**
     * Key value
     * @var array
     */
    private array $value;

    /**
     * KeyValueCreated constructor.
     * @param string $path
     * @param array $value
     * @param UserInterface|int|null $user
     */
    public function __construct(string $path, array $value, UserInterface|int|null $user = null)
    {
        $this->path = $path;
        $this->value = $value;
        $this->user = $user;
        parent::__construct();
    }

    /**
     * Get key path
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * Get key value
     * @return array
     */
    public function getValue(): array
    {
        return $this->value;
    }

    /**
     * Check if this is a reference
     * @return bool
     */
    public function isReference(): bool
    {
        return Arr::get($this->getValue(), 'type') === 'reference';
    }
}
