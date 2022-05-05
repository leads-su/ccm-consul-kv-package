<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Stats;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Consul\KeyValue\Interfaces\KeyValueRepositoryInterface;

/**
 * Class KeyValueStatsInteractor
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Stats
 */
class KeyValueStatsInteractor implements KeyValueStatsInputPort
{
    /**
     * Output instance
     * @var KeyValueStatsOutputPort
     */
    private KeyValueStatsOutputPort $output;

    /**
     * Repository instance
     * @var KeyValueRepositoryInterface
     */
    private KeyValueRepositoryInterface $repository;

    /**
     * KeyValueStatsInteractor constructor.
     * @param KeyValueStatsOutputPort $output
     * @param KeyValueRepositoryInterface $repository
     * @return void
     */
    public function __construct(KeyValueStatsOutputPort $output, KeyValueRepositoryInterface $repository)
    {
        $this->output = $output;
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function stats(KeyValueStatsRequestModel $requestModel): ViewModel
    {
        try {
            return $this->output->stats(new KeyValueStatsResponseModel([
                'references'        =>  $this->repository->countForField('reference', true),
                'actual'            =>  $this->repository->countForField('reference', false),
                'total'             =>  $this->repository->count(),
            ]));
            // @codeCoverageIgnoreStart
        } catch (Throwable $throwable) {
            return $this->output->internalServerError(new KeyValueStatsResponseModel(), $throwable);
        }
        // @codeCoverageIgnoreEnd
    }
}
