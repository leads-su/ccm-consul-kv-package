<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Get;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface KeyValuePendingGetOutputPort
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Get
 */
interface KeyValuePendingGetOutputPort
{
    /**
     * Output port for "get"
     * @param KeyValuePendingGetResponseModel $responseModel
     * @return ViewModel
     */
    public function get(KeyValuePendingGetResponseModel $responseModel): ViewModel;

    /**
     * Output port for "not found"
     * @param KeyValuePendingGetResponseModel $responseModel
     * @return ViewModel
     */
    public function notFound(KeyValuePendingGetResponseModel $responseModel): ViewModel;

    /**
     * Output port for "internal server error"
     * @param KeyValuePendingGetResponseModel $responseModel
     * @param Throwable $throwable
     * @return ViewModel
     */
    public function internalServerError(KeyValuePendingGetResponseModel $responseModel, Throwable $throwable): ViewModel;
}
