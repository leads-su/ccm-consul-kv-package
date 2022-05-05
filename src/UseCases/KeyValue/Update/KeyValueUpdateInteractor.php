<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Update;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use ConsulConfigManager\Consul\KeyValue\Interfaces\KeyValueRepositoryInterface;

/**
 * Class KeyValueUpdateInteractor
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Update
 */
class KeyValueUpdateInteractor implements KeyValueUpdateInputPort
{
    /**
     * Output port instance
     * @var KeyValueUpdateOutputPort
     */
    private KeyValueUpdateOutputPort $output;

    /**
     * Repository instance
     * @var KeyValueRepositoryInterface
     */
    private KeyValueRepositoryInterface $repository;

    /**
     * KeyValueUpdateInteractor constructor.
     * @param KeyValueUpdateOutputPort $output
     * @param KeyValueRepositoryInterface $repository
     * @return void
     */
    public function __construct(KeyValueUpdateOutputPort $output, KeyValueRepositoryInterface $repository)
    {
        $this->output = $output;
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function update(KeyValueUpdateRequestModel $requestModel): ViewModel
    {
        try {
            $entity = $this->repository->update($requestModel->getPath(), $requestModel->getValue());
            return $this->output->update(new KeyValueUpdateResponseModel($entity));
        } catch (Throwable $throwable) {
            if ($throwable instanceof ModelNotFoundException) {
                return $this->output->notFound(new KeyValueUpdateResponseModel());
            }
            // @codeCoverageIgnoreStart
            return $this->output->internalServerError(new KeyValueUpdateResponseModel(), $throwable);
            // @codeCoverageIgnoreEnd
        }
    }
}
