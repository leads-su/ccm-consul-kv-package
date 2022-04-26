<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Stats;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Consul\KeyValue\Interfaces\KeyValuePendingRepositoryInterface;

/**
 * Class KeyValuePendingStatsInteractor
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Stats
 */
class KeyValuePendingStatsInteractor implements KeyValuePendingStatsInputPort
{
    /**
     * Output instance
     * @var KeyValuePendingStatsOutputPort
     */
    private KeyValuePendingStatsOutputPort $output;

    /**
     * Repository instance
     * @var KeyValuePendingRepositoryInterface
     */
    private KeyValuePendingRepositoryInterface $repository;

    /**
     * KeyValuePendingStatsInteractor constructor.
     * @param KeyValuePendingStatsOutputPort $output
     * @param KeyValuePendingRepositoryInterface $repository
     * @return void
     */
    public function __construct(KeyValuePendingStatsOutputPort $output, KeyValuePendingRepositoryInterface $repository)
    {
        $this->output = $output;
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function stats(KeyValuePendingStatsRequestModel $requestModel): ViewModel
    {
        try {
            return $this->output->stats(new KeyValuePendingStatsResponseModel([
                'total'             =>  $this->repository->count(),
            ]));
            // @codeCoverageIgnoreStart
        } catch (Throwable $throwable) {
            return $this->output->internalServerError(new KeyValuePendingStatsResponseModel(), $throwable);
        }
        // @codeCoverageIgnoreEnd
    }
}
