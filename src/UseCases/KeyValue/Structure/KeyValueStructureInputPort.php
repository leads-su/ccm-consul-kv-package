<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Structure;

use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface KeyValueStructureInputPort
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\Structure
 */
interface KeyValueStructureInputPort
{
    /**
     * Input port for "structure"
     * @param KeyValueStructureRequestModel $requestModel
     * @return ViewModel
     */
    public function structure(KeyValueStructureRequestModel $requestModel): ViewModel;
}
