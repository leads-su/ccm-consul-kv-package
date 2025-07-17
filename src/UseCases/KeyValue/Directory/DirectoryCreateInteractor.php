<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Directory;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Consul\KeyValue\Interfaces\KeyValueServiceInterface;

/**
 * Class DirectoryCreateInteractor
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Directory
 */
class DirectoryCreateInteractor implements DirectoryCreateInputPort
{
    /**
     * Output port instance
     * @var DirectoryCreateOutputPort
     */
    private DirectoryCreateOutputPort $output;

    /**
     * Service instance
     * @var KeyValueServiceInterface
     */
    private KeyValueServiceInterface $service;

    /**
     * DirectoryCreateInteractor constructor.
     * @param DirectoryCreateOutputPort $output
     * @param KeyValueServiceInterface $service
     * @return void
     */
    public function __construct(DirectoryCreateOutputPort $output, KeyValueServiceInterface $service)
    {
        $this->output = $output;
        $this->service = $service;
    }

    /**
     * @inheritDoc
     */
    public function create(DirectoryCreateRequestModel $requestModel): ViewModel
    {
        try {
            $result = $this->service->createDirectory($requestModel->getPath());
            return $this->output->create(new DirectoryCreateResponseModel($result));
            // @codeCoverageIgnoreStart
        } catch (Throwable $throwable) {
            return $this->output->internalServerError(new DirectoryCreateResponseModel(), $throwable);
        }
        // @codeCoverageIgnoreEnd
    }
}