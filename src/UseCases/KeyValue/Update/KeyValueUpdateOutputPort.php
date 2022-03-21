<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Update;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface KeyValueUpdateOutputPort
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Update
 */
interface KeyValueUpdateOutputPort
{
    /**
     * Output port for "update"
     * @param KeyValueUpdateResponseModel $responseModel
     * @return ViewModel
     */
    public function update(KeyValueUpdateResponseModel $responseModel): ViewModel;

    /**
     * Output port for "not found"
     * @param KeyValueUpdateResponseModel $responseModel
     * @return ViewModel
     */
    public function notFound(KeyValueUpdateResponseModel $responseModel): ViewModel;

    /**
     * Output port for "internal server error"
     * @param KeyValueUpdateResponseModel $responseModel
     * @param Throwable $throwable
     * @return ViewModel
     */
    public function internalServerError(KeyValueUpdateResponseModel $responseModel, Throwable $throwable): ViewModel;
}
