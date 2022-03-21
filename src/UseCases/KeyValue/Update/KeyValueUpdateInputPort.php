<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Update;

use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface KeyValueUpdateInputPort
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Update
 */
interface KeyValueUpdateInputPort
{
    /**
     * Input port for "update"
     * @param KeyValueUpdateRequestModel $requestModel
     * @return ViewModel
     */
    public function update(KeyValueUpdateRequestModel $requestModel): ViewModel;
}
