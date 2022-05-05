<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Create;

use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface KeyValuePendingCreateInputPort
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Create
 */
interface KeyValuePendingCreateInputPort
{
    /**
     * Input port for "create"
     * @param KeyValuePendingCreateRequestModel $requestModel
     * @return ViewModel
     */
    public function create(KeyValuePendingCreateRequestModel $requestModel): ViewModel;
}
