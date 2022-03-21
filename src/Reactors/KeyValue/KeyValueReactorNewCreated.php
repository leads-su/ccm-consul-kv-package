<?php

namespace ConsulConfigManager\Consul\KeyValue\Reactors\KeyValue;

use JsonException;
use Consul\Exceptions\RequestException;
use Illuminate\Contracts\Queue\ShouldQueue;
use Spatie\EventSourcing\EventHandlers\Reactors\Reactor;
use Illuminate\Contracts\Container\BindingResolutionException;
use ConsulConfigManager\Consul\KeyValue\Events\KeyValueCreated;
use ConsulConfigManager\Consul\KeyValue\Interfaces\KeyValueServiceInterface;
use ConsulConfigManager\Consul\KeyValue\Exceptions\KeyValueAlreadyExistsException;

// @codeCoverageIgnoreStart
/**
 * Class KeyValueReactorNewCreated
 * @package ConsulConfigManager\Consul\KeyValue\Reactors\KeyValue
 */
class KeyValueReactorNewCreated extends Reactor implements ShouldQueue
{
    /**
     * Name of the event to be handled by this class
     * @var string
     */
    protected string $handleEvent = KeyValueCreated::class;

    /**
     * Handle create event for non-existent key value
     * @param KeyValueCreated $event
     * @return void
     * @throws RequestException|BindingResolutionException|JsonException|KeyValueAlreadyExistsException
     */
    public function __invoke(KeyValueCreated $event): void
    {
        $service = app()->make(KeyValueServiceInterface::class);
        $service->createKeyValue($event->getPath(), $event->getValue());
    }
}
// @codeCoverageIgnoreEnd
