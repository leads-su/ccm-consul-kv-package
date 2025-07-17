<?php

namespace ConsulConfigManager\Consul\KeyValue\Presenters\KeyValue\Directory;

use Throwable;
use Illuminate\Http\Response;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Directory\DirectoryListKeysOutputPort;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Directory\DirectoryListKeysResponseModel;

/**
 * Class DirectoryListKeysHttpPresenter
 * @package ConsulConfigManager\Consul\KeyValue\Presenters\KeyValue\Directory
 */
class DirectoryListKeysHttpPresenter implements DirectoryListKeysOutputPort
{
    /**
     * @inheritDoc
     */
    public function list(DirectoryListKeysResponseModel $responseModel): ViewModel
    {
        return new HttpResponseViewModel(response_success(
            [
                'keys' => $responseModel->getKeys(),
            ],
            'Directory keys retrieved successfully',
            Response::HTTP_OK
        ));
    }

    /**
     * @inheritDoc
     */
    public function internalServerError(DirectoryListKeysResponseModel $responseModel, Throwable $throwable): ViewModel
    {
        return new HttpResponseViewModel(response_error(
            $throwable,
            'Unable to retrieve directory keys'
        ));
    }
}
