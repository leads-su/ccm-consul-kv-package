<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Directory;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Consul\KeyValue\Interfaces\KeyValueServiceInterface;

/**
 * Class DirectoryGetContentsInteractor
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Directory
 */
class DirectoryGetContentsInteractor implements DirectoryGetContentsInputPort
{
    /**
     * Output port instance
     * @var DirectoryGetContentsOutputPort
     */
    private DirectoryGetContentsOutputPort $output;

    /**
     * Service instance
     * @var KeyValueServiceInterface
     */
    private KeyValueServiceInterface $service;

    /**
     * DirectoryGetContentsInteractor constructor.
     * @param DirectoryGetContentsOutputPort $output
     * @param KeyValueServiceInterface $service
     * @return void
     */
    public function __construct(DirectoryGetContentsOutputPort $output, KeyValueServiceInterface $service)
    {
        $this->output = $output;
        $this->service = $service;
    }

    /**
     * @inheritDoc
     */
    public function get(DirectoryGetContentsRequestModel $requestModel): ViewModel
    {
        try {
            $result = $this->service->getDirectoryContents($requestModel->getPath());
            return $this->output->get(new DirectoryGetContentsResponseModel($result));
            // @codeCoverageIgnoreStart
        } catch (Throwable $throwable) {
            return $this->output->internalServerError(new DirectoryGetContentsResponseModel(), $throwable);
        }
        // @codeCoverageIgnoreEnd
    }
}
