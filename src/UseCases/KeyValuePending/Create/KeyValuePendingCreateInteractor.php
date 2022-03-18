<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Create;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Consul\KeyValue\Interfaces\KeyValuePendingRepositoryInterface;

/**
 * Class KeyValuePendingCreateInteractor
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Create
 */
class KeyValuePendingCreateInteractor implements KeyValuePendingCreateInputPort
{
    /**
     * Output port instance
     * @var KeyValuePendingCreateOutputPort
     */
    private KeyValuePendingCreateOutputPort $output;

    /**
     * Repository instance
     * @var KeyValuePendingRepositoryInterface
     */
    private KeyValuePendingRepositoryInterface $repository;

    /**
     * KeyValuePendingCreateInteractor constructor.
     * @param KeyValuePendingCreateOutputPort $output
     * @param KeyValuePendingRepositoryInterface $repository
     * @return void
     */
    public function __construct(KeyValuePendingCreateOutputPort $output, KeyValuePendingRepositoryInterface $repository)
    {
        $this->output = $output;
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function create(KeyValuePendingCreateRequestModel $requestModel): ViewModel
    {
        try {
            $entity = $this->repository->create($requestModel->getPath(), $requestModel->getValue());
            return $this->output->create(new KeyValuePendingCreateResponseModel($entity));
            // @codeCoverageIgnoreStart
        } catch (Throwable $throwable) {
            return $this->output->internalServerError(new KeyValuePendingCreateResponseModel(), $throwable);
        }
        // @codeCoverageIgnoreEnd
    }
}
