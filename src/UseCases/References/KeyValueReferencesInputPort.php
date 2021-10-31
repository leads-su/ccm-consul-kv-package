<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\References;

use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface KeyValueReferencesInputPort
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\References
 */
interface KeyValueReferencesInputPort
{
    /**
     * Get list of Key Value references
     * @param KeyValueReferencesRequestModel $requestModel
     * @return ViewModel
     */
    public function references(KeyValueReferencesRequestModel $requestModel): ViewModel;
}
