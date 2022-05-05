<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\List;

use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface KeyValuePendingListInputPort
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\List
 */
interface KeyValuePendingListInputPort
{
    /**
     * Input port for "list"
     * @param KeyValuePendingListRequestModel $requestModel
     * @return ViewModel
     */
    public function list(KeyValuePendingListRequestModel $requestModel): ViewModel;
}
