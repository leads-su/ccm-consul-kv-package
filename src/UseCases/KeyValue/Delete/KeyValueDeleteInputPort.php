<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Delete;

use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface KeyValueDeleteInputPort
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Delete
 */
interface KeyValueDeleteInputPort
{
    /**
     * Input port for "delete"
     * @param KeyValueDeleteRequestModel $requestModel
     * @return ViewModel
     */
    public function delete(KeyValueDeleteRequestModel $requestModel): ViewModel;
}
