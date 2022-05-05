<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Stats;

use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface KeyValueStatsInputPort
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Stats
 */
interface KeyValueStatsInputPort
{
    /**
     * Input port for "stats"
     * @param KeyValueStatsRequestModel $requestModel
     * @return ViewModel
     */
    public function stats(KeyValueStatsRequestModel $requestModel): ViewModel;
}
