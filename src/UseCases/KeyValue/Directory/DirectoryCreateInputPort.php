<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Directory;

use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface DirectoryCreateInputPort
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Directory
 */
interface DirectoryCreateInputPort
{
    /**
     * Create directory
     * @param DirectoryCreateRequestModel $requestModel
     * @return ViewModel
     */
    public function create(DirectoryCreateRequestModel $requestModel): ViewModel;
}
