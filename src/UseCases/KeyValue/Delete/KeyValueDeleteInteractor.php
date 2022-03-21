<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Delete;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Consul\KeyValue\Interfaces\KeyValueRepositoryInterface;

/**
 * Class KeyValueDeleteInteractor
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Delete
 */
class KeyValueDeleteInteractor implements KeyValueDeleteInputPort
{
    /**
     * Output port instance
     * @var KeyValueDeleteOutputPort
     */
    private KeyValueDeleteOutputPort $output;

    /**
     * Repository instance
     * @var KeyValueRepositoryInterface
     */
    private KeyValueRepositoryInterface $repository;

    /**
     * KeyValueDeleteInteractor constructor.
     * @param KeyValueDeleteOutputPort $output
     * @param KeyValueRepositoryInterface $repository
     * @return void
     */
    public function __construct(KeyValueDeleteOutputPort $output, KeyValueRepositoryInterface $repository)
    {
        $this->output = $output;
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function delete(KeyValueDeleteRequestModel $requestModel): ViewModel
    {
        try {
            $result = $this->repository->delete($requestModel->getIdentifier());
            if ($result) {
                return $this->output->delete(new KeyValueDeleteResponseModel());
            }
            return $this->output->notFound(new KeyValueDeleteResponseModel());
            // @codeCoverageIgnoreStart
        } catch (Throwable $throwable) {
            return $this->output->internalServerError(new KeyValueDeleteResponseModel(), $throwable);
        }
        // @codeCoverageIgnoreEnd
    }
}
