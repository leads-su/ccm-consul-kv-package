<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Get;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use ConsulConfigManager\Consul\KeyValue\Interfaces\KeyValuePendingRepositoryInterface;

/**
 * Class KeyValuePendingGetInteractor
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Get
 */
class KeyValuePendingGetInteractor implements KeyValuePendingGetInputPort
{
    /**
     * Output port instance
     * @var KeyValuePendingGetOutputPort
     */
    private KeyValuePendingGetOutputPort $output;

    /**
     * Repository instance
     * @var KeyValuePendingRepositoryInterface
     */
    private KeyValuePendingRepositoryInterface $repository;

    /**
     * KeyValuePendingGetInteractor constructor.
     * @param KeyValuePendingGetOutputPort $output
     * @param KeyValuePendingRepositoryInterface $repository
     * @return void
     */
    public function __construct(KeyValuePendingGetOutputPort $output, KeyValuePendingRepositoryInterface $repository)
    {
        $this->output = $output;
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function get(KeyValuePendingGetRequestModel $requestModel): ViewModel
    {
        try {
            return $this->output->get(new KeyValuePendingGetResponseModel(
                $this->repository->findOrFail($requestModel->getIdentifier())
            ));
        } catch (Throwable $exception) {
            if ($exception instanceof ModelNotFoundException) {
                return $this->output->notFound(new KeyValuePendingGetResponseModel());
            }
            // @codeCoverageIgnoreStart
            return $this->output->internalServerError(new KeyValuePendingGetResponseModel(), $exception);
            // @codeCoverageIgnoreEnd
        }
    }
}
