<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\Get;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use ConsulConfigManager\Consul\KeyValue\Interfaces\KeyValueRepositoryInterface;

/**
 * Class KeyValueGetInteractor
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\Get
 */
class KeyValueGetInteractor implements KeyValueGetInputPort
{
    /**
     * Output port instance
     * @var KeyValueGetOutputPort
     */
    private KeyValueGetOutputPort $output;

    /**
     * Key Value repository instance
     * @var KeyValueRepositoryInterface
     */
    private KeyValueRepositoryInterface $repository;

    /**
     * KeyValueGetInteractor constructor.
     * @param KeyValueGetOutputPort $output
     * @param KeyValueRepositoryInterface $repository
     * @return void
     */
    public function __construct(KeyValueGetOutputPort $output, KeyValueRepositoryInterface $repository)
    {
        $this->output = $output;
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function read(KeyValueGetRequestModel $requestModel): ViewModel
    {
        $key = $requestModel->getKey();

        try {
            return $this->output->read(new KeyValueGetResponseModel(
                $this->repository->findOrFail($key)
            ));
        } catch (Throwable $exception) {
            if ($exception instanceof ModelNotFoundException) {
                return $this->output->keyNotFound(new KeyValueGetResponseModel());
            }
            // @codeCoverageIgnoreStart
            return $this->output->internalServerError(new KeyValueGetResponseModel(), $exception);
            // @codeCoverageIgnoreEnd
        }
    }
}
