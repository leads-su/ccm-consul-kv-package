<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Create;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface KeyValuePendingCreateOutputPort
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Create
 */
interface KeyValuePendingCreateOutputPort
{
    /**
     * Output port for "create"
     * @param KeyValuePendingCreateResponseModel $responseModel
     * @return ViewModel
     */
    public function create(KeyValuePendingCreateResponseModel $responseModel): ViewModel;

    /**
     * Output port for "internal server error"
     * @param KeyValuePendingCreateResponseModel $responseModel
     * @param Throwable $throwable
     * @return ViewModel
     */
    public function internalServerError(KeyValuePendingCreateResponseModel $responseModel, Throwable $throwable): ViewModel;
}
