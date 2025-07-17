<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Directory;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface DirectoryListKeysOutputPort
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Directory
 */
interface DirectoryListKeysOutputPort
{
    /**
     * Output port for "list"
     * @param DirectoryListKeysResponseModel $responseModel
     * @return ViewModel
     */
    public function list(DirectoryListKeysResponseModel $responseModel): ViewModel;

    /**
     * Output port for "internal server error"
     * @param DirectoryListKeysResponseModel $responseModel
     * @param Throwable $throwable
     * @return ViewModel
     */
    public function internalServerError(DirectoryListKeysResponseModel $responseModel, Throwable $throwable): ViewModel;
}
