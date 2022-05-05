<?php

namespace ConsulConfigManager\Consul\KeyValue\Reactors\KeyValue;

use Consul\Exceptions\RequestException;
use Illuminate\Contracts\Queue\ShouldQueue;
use Spatie\EventSourcing\EventHandlers\Reactors\Reactor;
use Illuminate\Contracts\Container\BindingResolutionException;
use ConsulConfigManager\Consul\KeyValue\Events\KeyValueDeleted;
use ConsulConfigManager\Consul\KeyValue\Interfaces\KeyValueServiceInterface;

// @codeCoverageIgnoreStart
/**
 * Class KeyValueReactorExistingDeleted
 * @package ConsulConfigManager\Consul\KeyValue\Reactors\KeyValue
 */
class KeyValueReactorExistingDeleted extends Reactor implements ShouldQueue
{
    /**
     * Name of the event to be handled by this class
     * @var string
     */
    protected string $handleEvent = KeyValueDeleted::class;

    /**
     * Handle update event for existing key value item
     * @param KeyValueDeleted $event
     * @return void
     * @throws RequestException|BindingResolutionException
     */
    public function __invoke(KeyValueDeleted $event): void
    {
        $service = app()->make(KeyValueServiceInterface::class);
        $service->deleteKey($event->getPath());
    }
}
// @codeCoverageIgnoreEnd
