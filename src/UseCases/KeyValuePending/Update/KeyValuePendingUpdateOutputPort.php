<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Update;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface KeyValuePendingUpdateOutputPort
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Update
 */
interface KeyValuePendingUpdateOutputPort
{
    /**
     * Output port for "update"
     * @param KeyValuePendingUpdateResponseModel $responseModel
     * @return ViewModel
     */
    public function update(KeyValuePendingUpdateResponseModel $responseModel): ViewModel;

    /**
     * Output port for "not found"
     * @param KeyValuePendingUpdateResponseModel $responseModel
     * @return ViewModel
     */
    public function notFound(KeyValuePendingUpdateResponseModel $responseModel): ViewModel;

    /**
     * Output port for "internal server error"
     * @param KeyValuePendingUpdateResponseModel $responseModel
     * @param Throwable $throwable
     * @return ViewModel
     */
    public function internalServerError(KeyValuePendingUpdateResponseModel $responseModel, Throwable $throwable): ViewModel;
}
