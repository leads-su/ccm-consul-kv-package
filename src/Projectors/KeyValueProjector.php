<?php

namespace ConsulConfigManager\Consul\KeyValue\Projectors;

use ConsulConfigManager\Consul\KeyValue\Events;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;
use ConsulConfigManager\Consul\KeyValue\Models\KeyValue as KeyValueModel;

/**
 * Class KeyValueProjector
 * @package ConsulConfigManager\Consul\KeyValue\Projectors
 */
class KeyValueProjector extends Projector
{
    /**
     * Handle `created` event
     * @param Events\KeyValueCreated $event
     * @return void
     */
    public function onCreated(Events\KeyValueCreated $event): void
    {
        KeyValueModel::create([
            'uuid'      =>  $event->aggregateRootUuid(),
            'path'      =>  trim($event->getPath()),
            'value'     =>  $event->getValue(),
            'reference' =>  $event->isReference(),
        ]);
    }

    /**
     * Handle `updated` event
     * @param Events\KeyValueUpdated $event
     * @return void
     */
    public function onUpdated(Events\KeyValueUpdated $event): void
    {
        $model = KeyValueModel::uuid($event->aggregateRootUuid());
        $model->setValue($event->getValue());
        $model->markAsReference($event->isReference());
        $model->save();
    }

    /**
     * Handle `deleted` event
     * @param Events\KeyValueDeleted $event
     * @return void
     */
    public function onDeleted(Events\KeyValueDeleted $event): void
    {
        KeyValueModel::uuid($event->aggregateRootUuid())->delete();
    }
}
