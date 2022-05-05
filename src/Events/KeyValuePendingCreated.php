<?php

namespace ConsulConfigManager\Consul\KeyValue\Events;

use ConsulConfigManager\Users\Interfaces\UserInterface;

/**
 * Class KeyValuePendingCreated
 * @package ConsulConfigManager\Consul\KeyValue\Events
 */
class KeyValuePendingCreated extends AbstractEvent
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
     * KeyValuePendingCreated constructor.
     * @param string $path
     * @param array $value
     * @param UserInterface|int|null $user
     * @return void
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
}
