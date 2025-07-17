<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Directory;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface DirectoryGetContentsOutputPort
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Directory
 */
interface DirectoryGetContentsOutputPort
{
    /**
     * Output port for "get"
     * @param DirectoryGetContentsResponseModel $responseModel
     * @return ViewModel
     */
    public function get(DirectoryGetContentsResponseModel $responseModel): ViewModel;

    /**
     * Output port for "internal server error"
     * @param DirectoryGetContentsResponseModel $responseModel
     * @param Throwable $throwable
     * @return ViewModel
     */
    public function internalServerError(DirectoryGetContentsResponseModel $responseModel, Throwable $throwable): ViewModel;
}
