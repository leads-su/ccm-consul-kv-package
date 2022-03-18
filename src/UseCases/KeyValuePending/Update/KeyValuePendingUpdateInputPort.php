<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Update;

use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface KeyValuePendingUpdateInputPort
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Update
 */
interface KeyValuePendingUpdateInputPort
{
    /**
     * Input port for "update"
     * @param KeyValuePendingUpdateRequestModel $requestModel
     * @return ViewModel
     */
    public function update(KeyValuePendingUpdateRequestModel $requestModel): ViewModel;
}
