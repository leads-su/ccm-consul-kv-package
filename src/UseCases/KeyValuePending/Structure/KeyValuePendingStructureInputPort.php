<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Structure;

use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface KeyValuePendingStructureInputPort
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\Structure
 */
interface KeyValuePendingStructureInputPort
{
    /**
     * Input port for "structure"
     * @param KeyValuePendingStructureRequestModel $requestModel
     * @return ViewModel
     */
    public function structure(KeyValuePendingStructureRequestModel $requestModel): ViewModel;
}
