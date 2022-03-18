<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Delete;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface KeyValuePendingDeleteOutputPort
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Delete
 */
interface KeyValuePendingDeleteOutputPort
{
    /**
     * Output port for "delete"
     * @param KeyValuePendingDeleteResponseModel $responseModel
     * @return ViewModel
     */
    public function delete(KeyValuePendingDeleteResponseModel $responseModel): ViewModel;

    /**
     * Output port for "internal server error"
     * @param KeyValuePendingDeleteResponseModel $responseModel
     * @param Throwable $throwable
     * @return ViewModel
     */
    public function internalServerError(KeyValuePendingDeleteResponseModel $responseModel, Throwable $throwable): ViewModel;
}
