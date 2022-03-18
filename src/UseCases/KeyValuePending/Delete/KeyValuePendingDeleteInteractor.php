<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Delete;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Consul\KeyValue\Interfaces\KeyValuePendingRepositoryInterface;

/**
 * Class KeyValuePendingDeleteInteractor
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Delete
 */
class KeyValuePendingDeleteInteractor implements KeyValuePendingDeleteInputPort
{
    /**
     * Output port instance
     * @var KeyValuePendingDeleteOutputPort
     */
    private KeyValuePendingDeleteOutputPort $output;

    /**
     * Repository instance
     * @var KeyValuePendingRepositoryInterface
     */
    private KeyValuePendingRepositoryInterface $repository;

    /**
     * KeyValuePendingDeleteInteractor constructor.
     * @param KeyValuePendingDeleteOutputPort $output
     * @param KeyValuePendingRepositoryInterface $repository
     * @return void
     */
    public function __construct(KeyValuePendingDeleteOutputPort $output, KeyValuePendingRepositoryInterface $repository)
    {
        $this->output = $output;
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function delete(KeyValuePendingDeleteRequestModel $requestModel): ViewModel
    {
        try {
            $this->repository->delete($requestModel->getIdentifier());
            return $this->output->delete(new KeyValuePendingDeleteResponseModel());
            // @codeCoverageIgnoreStart
        } catch (Throwable $throwable) {
            return $this->output->internalServerError(new KeyValuePendingDeleteResponseModel(), $throwable);
        }
        // @codeCoverageIgnoreEnd
    }
}
