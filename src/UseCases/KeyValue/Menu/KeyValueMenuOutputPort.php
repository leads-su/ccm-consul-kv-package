<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Menu;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface KeyValueMenuOutputPort
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\Menu
 */
interface KeyValueMenuOutputPort
{
    /**
     * Output port for "menu"
     * @param KeyValueMenuResponseModel $responseModel
     * @return ViewModel
     */
    public function menu(KeyValueMenuResponseModel $responseModel): ViewModel;

    /**
     * Output port for "internal server error"
     * @param KeyValueMenuResponseModel $responseModel
     * @param Throwable $throwable
     * @return ViewModel
     */
    public function internalServerError(KeyValueMenuResponseModel $responseModel, Throwable $throwable): ViewModel;
}
