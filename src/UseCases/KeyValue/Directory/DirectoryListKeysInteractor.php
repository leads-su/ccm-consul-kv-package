<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Directory;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Consul\KeyValue\Interfaces\KeyValueServiceInterface;

/**
 * Class DirectoryListKeysInteractor
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Directory
 */
class DirectoryListKeysInteractor implements DirectoryListKeysInputPort
{
    /**
     * Output port instance
     * @var DirectoryListKeysOutputPort
     */
    private DirectoryListKeysOutputPort $output;

    /**
     * Service instance
     * @var KeyValueServiceInterface
     */
    private KeyValueServiceInterface $service;

    /**
     * DirectoryListKeysInteractor constructor.
     * @param DirectoryListKeysOutputPort $output
     * @param KeyValueServiceInterface $service
     * @return void
     */
    public function __construct(DirectoryListKeysOutputPort $output, KeyValueServiceInterface $service)
    {
        $this->output = $output;
        $this->service = $service;
    }

    /**
     * @inheritDoc
     */
    public function list(DirectoryListKeysRequestModel $requestModel): ViewModel
    {
        try {
            $result = $this->service->listDirectoryKeys($requestModel->getPath());
            return $this->output->list(new DirectoryListKeysResponseModel($result));
            // @codeCoverageIgnoreStart
        } catch (Throwable $throwable) {
            return $this->output->internalServerError(new DirectoryListKeysResponseModel(), $throwable);
        }
        // @codeCoverageIgnoreEnd
    }
}
