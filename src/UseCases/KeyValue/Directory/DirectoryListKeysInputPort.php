<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Directory;

use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface DirectoryListKeysInputPort
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Directory
 */
interface DirectoryListKeysInputPort
{
    /**
     * List directory keys
     * @param DirectoryListKeysRequestModel $requestModel
     * @return ViewModel
     */
    public function list(DirectoryListKeysRequestModel $requestModel): ViewModel;
}
