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
     * KeyValueDeleted constructor.
     * @param UserInterface|int|null $user
     */
    public function __construct(UserInterface|int|null $user = null)
    {
        $this->user = $user;
        parent::__construct();
    }
}
