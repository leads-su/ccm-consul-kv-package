<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Stats;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface KeyValueStatsOutputPort
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Stats
 */
interface KeyValueStatsOutputPort
{
    /**
     * Output port for "stats"
     * @param KeyValueStatsResponseModel $responseModel
     * @return ViewModel
     */
    public function stats(KeyValueStatsResponseModel $responseModel): ViewModel;

    /**
     * Output port for "internal server error"
     * @param KeyValueStatsResponseModel $responseModel
     * @param Throwable $throwable
     * @return ViewModel
     */
    public function internalServerError(KeyValueStatsResponseModel $responseModel, Throwable $throwable): ViewModel;
}
