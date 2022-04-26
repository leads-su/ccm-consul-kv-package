<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Stats;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface KeyValuePendingStatsOutputPort
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Stats
 */
interface KeyValuePendingStatsOutputPort
{
    /**
     * Output port for "stats"
     * @param KeyValuePendingStatsResponseModel $responseModel
     * @return ViewModel
     */
    public function stats(KeyValuePendingStatsResponseModel $responseModel): ViewModel;

    /**
     * Output port for "internal server error"
     * @param KeyValuePendingStatsResponseModel $responseModel
     * @param Throwable $throwable
     * @return ViewModel
     */
    public function internalServerError(KeyValuePendingStatsResponseModel $responseModel, Throwable $throwable): ViewModel;
}
