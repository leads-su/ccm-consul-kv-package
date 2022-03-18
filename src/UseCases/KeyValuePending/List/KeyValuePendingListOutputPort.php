<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\List;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface KeyValuePendingListOutputPort
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\List
 */
interface KeyValuePendingListOutputPort
{
    /**
     * Output port for "list"
     * @param KeyValuePendingListResponseModel $responseModel
     * @return ViewModel
     */
    public function list(KeyValuePendingListResponseModel $responseModel): ViewModel;

    /**
     * Output port for "internal server error"
     * @param KeyValuePendingListResponseModel $responseModel
     * @param Throwable $throwable
     * @return ViewModel
     */
    public function internalServerError(KeyValuePendingListResponseModel $responseModel, Throwable $throwable): ViewModel;
}
