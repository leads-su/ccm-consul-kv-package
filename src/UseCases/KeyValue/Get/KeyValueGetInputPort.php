<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Get;

use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface KeyValueGetInputPort
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\Get
 */
interface KeyValueGetInputPort
{
    /**
     * @param KeyValueGetRequestModel $requestModel
     * @return ViewModel
     */
    public function read(KeyValueGetRequestModel $requestModel): ViewModel;
}
