<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Create;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Consul\KeyValue\Interfaces\KeyValueRepositoryInterface;

/**
 * Class KeyValueCreateInteractor
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Create
 */
class KeyValueCreateInteractor implements KeyValueCreateInputPort
{
    /**
     * Output port instance
     * @var KeyValueCreateOutputPort
     */
    private KeyValueCreateOutputPort $output;

    /**
     * Repository instance
     * @var KeyValueRepositoryInterface
     */
    private KeyValueRepositoryInterface $repository;

    /**
     * KeyValueCreateInteractor constructor.
     * @param KeyValueCreateOutputPort $output
     * @param KeyValueRepositoryInterface $repository
     * @return void
     */
    public function __construct(KeyValueCreateOutputPort $output, KeyValueRepositoryInterface $repository)
    {
        $this->output = $output;
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function create(KeyValueCreateRequestModel $requestModel): ViewModel
    {
        try {
            $entity = $this->repository->create($requestModel->getPath(), $requestModel->getValue());
            return $this->output->create(new KeyValueCreateResponseModel($entity));
            // @codeCoverageIgnoreStart
        } catch (Throwable $throwable) {
            return $this->output->internalServerError(new KeyValueCreateResponseModel(), $throwable);
        }
        // @codeCoverageIgnoreEnd
    }
}
