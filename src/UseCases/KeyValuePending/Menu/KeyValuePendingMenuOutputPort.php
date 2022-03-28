<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Menu;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface KeyValuePendingMenuOutputPort
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\Menu
 */
interface KeyValuePendingMenuOutputPort
{
    /**
     * Output port for "menu"
     * @param KeyValuePendingMenuResponseModel $responseModel
     * @return ViewModel
     */
    public function menu(KeyValuePendingMenuResponseModel $responseModel): ViewModel;

    /**
     * Output port for "internal server error"
     * @param KeyValuePendingMenuResponseModel $responseModel
     * @param Throwable $throwable
     * @return ViewModel
     */
    public function internalServerError(KeyValuePendingMenuResponseModel $responseModel, Throwable $throwable): ViewModel;
}
