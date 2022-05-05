<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Delete;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface KeyValueDeleteOutputPort
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Delete
 */
interface KeyValueDeleteOutputPort
{
    /**
     * Output port for "delete"
     * @param KeyValueDeleteResponseModel $responseModel
     * @return ViewModel
     */
    public function delete(KeyValueDeleteResponseModel $responseModel): ViewModel;

    /**
     * Output port for "not found"
     * @param KeyValueDeleteResponseModel $responseModel
     * @return ViewModel
     */
    public function notFound(KeyValueDeleteResponseModel $responseModel): ViewModel;

    /**
     * Output port for "internal server error"
     * @param KeyValueDeleteResponseModel $responseModel
     * @param Throwable $throwable
     * @return ViewModel
     */
    public function internalServerError(KeyValueDeleteResponseModel $responseModel, Throwable $throwable): ViewModel;
}
