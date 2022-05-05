<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Delete;

use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface KeyValuePendingDeleteInputPort
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Delete
 */
interface KeyValuePendingDeleteInputPort
{
    /**
     * Input port for "delete"
     * @param KeyValuePendingDeleteRequestModel $requestModel
     * @return ViewModel
     */
    public function delete(KeyValuePendingDeleteRequestModel $requestModel): ViewModel;
}
