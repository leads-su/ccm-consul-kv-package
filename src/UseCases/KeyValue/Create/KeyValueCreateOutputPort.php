<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Create;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface KeyValueCreateOutputPort
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Create
 */
interface KeyValueCreateOutputPort
{
    /**
     * Output port for "create"
     * @param KeyValueCreateResponseModel $responseModel
     * @return ViewModel
     */
    public function create(KeyValueCreateResponseModel $responseModel): ViewModel;

    /**
     * Output port for "internal server error"
     * @param KeyValueCreateResponseModel $responseModel
     * @param Throwable $throwable
     * @return ViewModel
     */
    public function internalServerError(KeyValueCreateResponseModel $responseModel, Throwable $throwable): ViewModel;
}
