<?php

namespace ConsulConfigManager\Consul\KeyValue\Presenters\KeyValue\Directory;

use Throwable;
use Illuminate\Http\Response;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Directory\DirectoryCreateOutputPort;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Directory\DirectoryCreateResponseModel;

/**
 * Class DirectoryCreateHttpPresenter
 * @package ConsulConfigManager\Consul\KeyValue\Presenters\KeyValue\Directory
 */
class DirectoryCreateHttpPresenter implements DirectoryCreateOutputPort
{
    /**
     * @inheritDoc
     */
    public function create(DirectoryCreateResponseModel $responseModel): ViewModel
    {
        return new HttpResponseViewModel(response_success(
            [
                'success' => $responseModel->getResult(),
            ],
            'Directory created successfully',
            Response::HTTP_CREATED
        ));
    }

    /**
     * @inheritDoc
     */
    public function internalServerError(DirectoryCreateResponseModel $responseModel, Throwable $throwable): ViewModel
    {
        return new HttpResponseViewModel(response_error(
            $throwable,
            'Unable to create directory'
        ));
    }
}
