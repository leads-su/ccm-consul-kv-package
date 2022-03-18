<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Namespaced;

use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface KeyValueNamespacedInputPort
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\Namespaced
 */
interface KeyValueNamespacedInputPort
{
    /**
     * Get list of Key Value entries in a namespaced style
     * @param KeyValueNamespacedRequestModel $requestModel
     * @return ViewModel
     */
    public function namespaced(KeyValueNamespacedRequestModel $requestModel): ViewModel;
}
