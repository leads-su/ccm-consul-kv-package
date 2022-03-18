<?php

namespace ConsulConfigManager\Consul\KeyValue\Events;

use Illuminate\Support\Arr;
use ConsulConfigManager\Users\Interfaces\UserInterface;

/**
 * Class KeyValueUpdated
 * @package ConsulConfigManager\Consul\KeyValue\Events
 */
class KeyValueUpdated extends AbstractEvent
{
    /**
     * Key value
     * @var array
     */
    private array $value;

    /**
     * KeyValueUpdated constructor.
     * @param array $value
     * @param UserInterface|int|null $user
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

    /**
     * Check if this is a reference
     * @return bool
     */
    public function isReference(): bool
    {
        return Arr::get($this->getValue(), 'type') === 'reference';
    }
}
