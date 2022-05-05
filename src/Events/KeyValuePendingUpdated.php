<?php

namespace ConsulConfigManager\Consul\KeyValue\Events;

use ConsulConfigManager\Users\Interfaces\UserInterface;

/**
 * Class KeyValuePendingUpdated
 * @package ConsulConfigManager\Consul\KeyValue\Events
 */
class KeyValuePendingUpdated extends AbstractEvent
{
    /**
     * Key value
     * @var array
     */
    private array $value;

    /**
     * KeyValuePendingUpdated constructor.
     * @param array $value
     * @param UserInterface|int|null $user
     * @return void
     */
    public function __construct(array $value, UserInterface|int|null $user = null)
    {
        $this->value = $value;
        $this->user = $user;
        parent::__construct();
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
