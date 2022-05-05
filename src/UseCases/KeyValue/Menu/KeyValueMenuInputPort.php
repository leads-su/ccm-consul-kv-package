<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Menu;

use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface KeyValueMenuInputPort
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\Menu
 */
interface KeyValueMenuInputPort
{
    /**
     * Input port for "menu"
     * @param KeyValueMenuRequestModel $requestModel
     * @return ViewModel
     */
    public function menu(KeyValueMenuRequestModel $requestModel): ViewModel;
}
