<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Stats;

use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface KeyValuePendingStatsInputPort
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Stats
 */
interface KeyValuePendingStatsInputPort
{
    /**
     * Input port for "stats"
     * @param KeyValuePendingStatsRequestModel $requestModel
     * @return ViewModel
     */
    public function stats(KeyValuePendingStatsRequestModel $requestModel): ViewModel;
}
