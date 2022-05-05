<?php

namespace ConsulConfigManager\Consul\KeyValue\Projectors;

use ConsulConfigManager\Consul\KeyValue\Events;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;
use ConsulConfigManager\Consul\KeyValue\Models\KeyValuePending as KeyValuePendingModel;

/**
 * Class KeyValuePendingProjector
 * @package ConsulConfigManager\Consul\KeyValue\Projectors
 */
class KeyValuePendingProjector extends Projector
{
    /**
     * Handle `created` event
     * @param Events\KeyValuePendingCreated $event
     * @return void
     */
    public function onCreated(Events\KeyValuePendingCreated $event): void
    {
        KeyValuePendingModel::create([
            'uuid'      =>  $event->aggregateRootUuid(),
            'path'      =>  trim($event->getPath()),
            'value'     =>  $event->getValue(),
        ]);
    }

    /**
     * Handle `updated` event
     * @param Events\KeyValuePendingUpdated $event
     * @return void
     */
    public function onUpdated(Events\KeyValuePendingUpdated $event): void
    {
        $model = KeyValuePendingModel::uuid($event->aggregateRootUuid());
        $model->setValue($event->getValue());
        $model->save();
    }

    /**
     * Handle `deleted` event
     * @param Events\KeyValuePendingDeleted $event
     * @return void
     */
    public function onDeleted(Events\KeyValuePendingDeleted $event): void
    {
        KeyValuePendingModel::uuid($event->aggregateRootUuid())->delete();
    }
}
