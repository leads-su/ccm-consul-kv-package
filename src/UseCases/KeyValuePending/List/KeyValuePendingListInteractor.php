<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\List;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Consul\KeyValue\Interfaces\KeyValuePendingRepositoryInterface;

/**
 * Class KeyValuePendingListInteractor
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\List
 */
class KeyValuePendingListInteractor implements KeyValuePendingListInputPort
{
    /**
     * Output port instance
     * @var KeyValuePendingListOutputPort
     */
    private KeyValuePendingListOutputPort $output;

    /**
     * Repository instance
     * @var KeyValuePendingRepositoryInterface
     */
    private KeyValuePendingRepositoryInterface $repository;

    /**
     * KeyValuePendingListInteractor constructor.
     * @param KeyValuePendingListOutputPort $output
     * @param KeyValuePendingRepositoryInterface $repository
     * @return void
     */
    public function __construct(KeyValuePendingListOutputPort $output, KeyValuePendingRepositoryInterface $repository)
    {
        $this->output = $output;
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function list(KeyValuePendingListRequestModel $requestModel): ViewModel
    {
        try {
            return $this->output->list(new KeyValuePendingListResponseModel(
                $this->repository->all()
            ));
            // @codeCoverageIgnoreStart
        } catch (Throwable $throwable) {
            return $this->output->internalServerError(new KeyValuePendingListResponseModel(), $throwable);
        }
        // @codeCoverageIgnoreEnd
    }
}
