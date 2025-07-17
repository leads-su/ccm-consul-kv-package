<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Directory;

use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface DirectoryGetContentsInputPort
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Directory
 */
interface DirectoryGetContentsInputPort
{
    /**
     * Get directory contents
     * @param DirectoryGetContentsRequestModel $requestModel
     * @return ViewModel
     */
    public function get(DirectoryGetContentsRequestModel $requestModel): ViewModel;
}
