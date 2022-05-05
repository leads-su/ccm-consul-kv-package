<?php

namespace ConsulConfigManager\Consul\KeyValue\Events;

use ConsulConfigManager\Users\Interfaces\UserInterface;

/**
 * Class KeyValueDeleted
 * @package ConsulConfigManager\Consul\KeyValue\Events
 */
class KeyValueDeleted extends AbstractEvent
{
    /**
     * Key value path
     * @var string
     */
    private string $path;

    /**
     * KeyValueDeleted constructor.
     * @param string $path
     * @param UserInterface|int|null $user
     */
    public function __construct(string $path, UserInterface|int|null $user = null)
    {
        $this->path = $path;
        $this->user = $user;
        parent::__construct();
    }

    /**
     * Get key value path
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }
}
