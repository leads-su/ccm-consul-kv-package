<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Get;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface KeyValueGetOutputPort
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\Get
 */
interface KeyValueGetOutputPort
{
    /**
     * Output port for "read"
     * @param KeyValueGetResponseModel $responseModel
     * @return ViewModel
     */
    public function read(KeyValueGetResponseModel $responseModel): ViewModel;

    /**
     * Output port for "key not found"
     * @param KeyValueGetResponseModel $responseModel
     * @return ViewModel
     */
    public function keyNotFound(KeyValueGetResponseModel $responseModel): ViewModel;

    /**
     * Output port for "internal server error"
     * @param KeyValueGetResponseModel $responseModel
     * @param Throwable $exception
     * @return ViewModel
     */
    public function internalServerError(KeyValueGetResponseModel $responseModel, Throwable $exception): ViewModel;
}
