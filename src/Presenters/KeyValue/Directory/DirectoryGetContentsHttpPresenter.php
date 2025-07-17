<?php

namespace ConsulConfigManager\Consul\KeyValue\Presenters\KeyValue\Directory;

use Throwable;
use Illuminate\Http\Response;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Directory\DirectoryGetContentsOutputPort;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Directory\DirectoryGetContentsResponseModel;

/**
 * Class DirectoryGetContentsHttpPresenter
 * @package ConsulConfigManager\Consul\KeyValue\Presenters\KeyValue\Directory
 */
class DirectoryGetContentsHttpPresenter implements DirectoryGetContentsOutputPort
{
    /**
     * @inheritDoc
     */
    public function get(DirectoryGetContentsResponseModel $responseModel): ViewModel
    {
        return new HttpResponseViewModel(response_success(
            [
                'contents' => $responseModel->getContents(),
            ],
            'Directory contents retrieved successfully',
            Response::HTTP_OK
        ));
    }

    /**
     * @inheritDoc
     */
    public function internalServerError(DirectoryGetContentsResponseModel $responseModel, Throwable $throwable): ViewModel
    {
        return new HttpResponseViewModel(response_error(
            $throwable,
            'Unable to retrieve directory contents'
        ));
    }
}
