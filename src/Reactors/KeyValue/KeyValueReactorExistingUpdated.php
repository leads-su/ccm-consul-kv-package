<?php

namespace ConsulConfigManager\Consul\KeyValue\Reactors\KeyValue;

use JsonException;
use Illuminate\Contracts\Queue\ShouldQueue;
use Spatie\EventSourcing\EventHandlers\Reactors\Reactor;
use Illuminate\Contracts\Container\BindingResolutionException;
use ConsulConfigManager\Consul\KeyValue\Events\KeyValueUpdated;
use ConsulConfigManager\Consul\KeyValue\Interfaces\KeyValueServiceInterface;
use ConsulConfigManager\Consul\KeyValue\Exceptions\KeyValueDoesNotExistsException;

// @codeCoverageIgnoreStart
/**
 * Class KeyValueReactorExistingUpdated
 * @package ConsulConfigManager\Consul\KeyValue\Reactors\KeyValue
 */
class KeyValueReactorExistingUpdated extends Reactor implements ShouldQueue
{
    /**
     * Name of the event to be handled by this class
     * @var string
     */
    protected string $handleEvent = KeyValueUpdated::class;

    /**
     * Handle update event for existing key value item
     * @param KeyValueUpdated $event
     * @return void
     * @throws BindingResolutionException|JsonException|KeyValueDoesNotExistsException
     */
    public function __invoke(KeyValueUpdated $event): void
    {
        $service = app()->make(KeyValueServiceInterface::class);
        $service->updateKeyValue($event->getPath(), $event->getValue());
    }
}
// @codeCoverageIgnoreEnd
