<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Structure;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface KeyValuePendingStructureOutputPort
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\Structure
 */
interface KeyValuePendingStructureOutputPort
{
    /**
     * Output port for "structure"
     * @param KeyValuePendingStructureResponseModel $responseModel
     * @return ViewModel
     */
    public function structure(KeyValuePendingStructureResponseModel $responseModel): ViewModel;

    /**
     * Output port for "internal server error"
     * @param KeyValuePendingStructureResponseModel $responseModel
     * @param Throwable $throwable
     * @return ViewModel
     */
    public function internalServerError(KeyValuePendingStructureResponseModel $responseModel, Throwable $throwable): ViewModel;
}
