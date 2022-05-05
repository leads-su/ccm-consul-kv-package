<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Menu;

use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface KeyValuePendingMenuInputPort
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\Menu
 */
interface KeyValuePendingMenuInputPort
{
    /**
     * Input port for "menu"
     * @param KeyValuePendingMenuRequestModel $requestModel
     * @return ViewModel
     */
    public function menu(KeyValuePendingMenuRequestModel $requestModel): ViewModel;
}
