<?php

namespace ConsulConfigManager\Consul\KeyValue\Events;

use Illuminate\Support\Carbon;
use Spatie\EventSourcing\StoredEvents\ShouldBeStored;
use ConsulConfigManager\Users\Interfaces\UserInterface;

/**
 * Class AbstractEvent
 * @package ConsulConfigManager\Consul\KeyValue\Events
 */
abstract class AbstractEvent extends ShouldBeStored
{
    /**
     * Timestamp of when event occurred
     * @var int
     */
    protected int $dateTime = 0;

    /**
     * Reference for user who triggered event
     * @var UserInterface|int|null
     */
    protected UserInterface|int|null $user = null;

    /**
     * AbstractEvent Constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->dateTime = time();
    }

    /**
     * Get event occurrence timestamp
     * @return int
     */
    public function getDateTime(): int
    {
        if (property_exists($this, 'dateTime') && $this->dateTime !== 0) {
            return $this->dateTime;
        }
        // @codeCoverageIgnoreStart
        return time();
        // @codeCoverageIgnoreEnd
    }

    /**
     * Set event occurrence time
     * @param Carbon|int $dateTime
     *
     * @return $this
     */
    public function setDateTime(Carbon|int $dateTime): AbstractEvent
    {
        $this->dateTime = is_int($dateTime) ? $dateTime : $dateTime->getTimestamp();
        return $this;
    }

    /**
     * Get user who triggered event
     * @return int
     */
    public function getUser(): int
    {
        if (property_exists($this, 'user') && $this->user !== null) {
            if (is_integer($this->user)) {
                // @codeCoverageIgnoreStart
                return $this->user;
                // @codeCoverageIgnoreEnd
            }
            return $this->user->getID();
        }
        return $this->retrieveUserID();
    }

    /**
     * Set user
     * @param UserInterface|int $user
     *
     * @return $this
     */
    public function setUser(UserInterface|int $user): AbstractEvent
    {
        $this->user = $user;
        return $this;
    }

    /**
     * Retrieve user id to store 'who created' data
     * @return int
     */
    protected function retrieveUserID(): int
    {
        $request = request();
        if ($request !== null) {
            /**
             * @var UserInterface $user
             */
            $user = $request->user();
            if ($user !== null) {
                // @codeCoverageIgnoreStart
                return $user->getID();
                // @codeCoverageIgnoreEnd
            }
        }
        return config('consul.kv.system_user.identifier', 1);
    }
}
