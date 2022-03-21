<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Create;

use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface KeyValueCreateInputPort
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Create
 */
interface KeyValueCreateInputPort
{
    /**
     * Input port for "create"
     * @param KeyValueCreateRequestModel $requestModel
     * @return ViewModel
     */
    public function create(KeyValueCreateRequestModel $requestModel): ViewModel;
}
