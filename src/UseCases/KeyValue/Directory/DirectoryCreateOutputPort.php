<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Directory;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface DirectoryCreateOutputPort
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Directory
 */
interface DirectoryCreateOutputPort
{
    /**
     * Output port for "create"
     * @param DirectoryCreateResponseModel $responseModel
     * @return ViewModel
     */
    public function create(DirectoryCreateResponseModel $responseModel): ViewModel;

    /**
     * Output port for "internal server error"
     * @param DirectoryCreateResponseModel $responseModel
     * @param Throwable $throwable
     * @return ViewModel
     */
    public function internalServerError(DirectoryCreateResponseModel $responseModel, Throwable $throwable): ViewModel;
}
