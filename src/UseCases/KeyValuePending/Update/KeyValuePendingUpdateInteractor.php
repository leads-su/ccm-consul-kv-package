<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Update;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use ConsulConfigManager\Consul\KeyValue\Interfaces\KeyValuePendingRepositoryInterface;

/**
 * Class KeyValuePendingUpdateInteractor
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Update
 */
class KeyValuePendingUpdateInteractor implements KeyValuePendingUpdateInputPort
{
    /**
     * Output port instance
     * @var KeyValuePendingUpdateOutputPort
     */
    private KeyValuePendingUpdateOutputPort $output;

    /**
     * Repository instance
     * @var KeyValuePendingRepositoryInterface
     */
    private KeyValuePendingRepositoryInterface $repository;

    /**
     * KeyValuePendingUpdateInteractor constructor.
     * @param KeyValuePendingUpdateOutputPort $output
     * @param KeyValuePendingRepositoryInterface $repository
     * @return void
     */
    public function __construct(KeyValuePendingUpdateOutputPort $output, KeyValuePendingRepositoryInterface $repository)
    {
        $this->output = $output;
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function update(KeyValuePendingUpdateRequestModel $requestModel): ViewModel
    {
        try {
            $entity = $this->repository->update($requestModel->getPath(), $requestModel->getValue());
            return $this->output->update(new KeyValuePendingUpdateResponseModel($entity));
        } catch (Throwable $throwable) {
            if ($throwable instanceof ModelNotFoundException) {
                return $this->output->notFound(new KeyValuePendingUpdateResponseModel());
            }
            // @codeCoverageIgnoreStart
            return $this->output->internalServerError(new KeyValuePendingUpdateResponseModel(), $throwable);
            // @codeCoverageIgnoreEnd
        }
    }
}
