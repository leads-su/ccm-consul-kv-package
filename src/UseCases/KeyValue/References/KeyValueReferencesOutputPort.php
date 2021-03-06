<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\References;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface KeyValueReferencesOutputPort
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\References
 */
interface KeyValueReferencesOutputPort
{
    /**
     * Output port for "references"
     * @param KeyValueReferencesResponseModel $responseModel
     * @return ViewModel
     */
    public function references(KeyValueReferencesResponseModel $responseModel): ViewModel;

    /**
     * Output port for "internal server error"
     * @param KeyValueReferencesResponseModel $responseModel
     * @param Throwable $exception
     * @return ViewModel
     */
    public function internalServerError(KeyValueReferencesResponseModel $responseModel, Throwable $exception): ViewModel;
}
