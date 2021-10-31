<?php

namespace ConsulConfigManager\Consul\KeyValue\Events;

use ConsulConfigManager\Users\Domain\Interfaces\UserEntity;

/**
 * Class KeyValueDeleted
 * @package ConsulConfigManager\Consul\KeyValue\Events
 */
class KeyValueDeleted extends AbstractEvent
{
    /**
     * KeyValueDeleted constructor.
     * @param UserEntity|int|null $user
     */
    public function __construct(UserEntity|int|null $user = null)
    {
        $this->user = $user;
        parent::__construct();
    }
}
