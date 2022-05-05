<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Structure;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface KeyValueStructureOutputPort
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\Structure
 */
interface KeyValueStructureOutputPort
{
    /**
     * Output port for "structure"
     * @param KeyValueStructureResponseModel $responseModel
     * @return ViewModel
     */
    public function structure(KeyValueStructureResponseModel $responseModel): ViewModel;

    /**
     * Output port for "internal server error"
     * @param KeyValueStructureResponseModel $responseModel
     * @param Throwable $throwable
     * @return ViewModel
     */
    public function internalServerError(KeyValueStructureResponseModel $responseModel, Throwable $throwable): ViewModel;
}
