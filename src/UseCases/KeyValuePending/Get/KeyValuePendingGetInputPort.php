<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Get;

use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface KeyValuePendingGetInputPort
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Get
 */
interface KeyValuePendingGetInputPort
{
    /**
     * Input port for "get"
     * @param KeyValuePendingGetRequestModel $requestModel
     * @return ViewModel
     */
    public function get(KeyValuePendingGetRequestModel $requestModel): ViewModel;
}
