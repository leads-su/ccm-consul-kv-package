<?php

namespace ConsulConfigManager\Consul\KeyValue\Presenters\KeyValuePending;

use Throwable;
use Illuminate\Http\Response;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Get\KeyValuePendingGetOutputPort;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Get\KeyValuePendingGetResponseModel;

/**
 * Class KeyValuePendingGetHttpPresenter
 * @package ConsulConfigManager\Consul\KeyValue\Presenters\KeyValuePending
 */
class KeyValuePendingGetHttpPresenter implements KeyValuePendingGetOutputPort
{
    /**
     * @inheritDoc
     */
    public function get(KeyValuePendingGetResponseModel $responseModel): ViewModel
    {
        return new HttpResponseViewModel(response_success(
            $responseModel->getEntity(),
            'Successfully fetched information for pending consul key value',
            Response::HTTP_OK,
        ));
    }

    /**
     * @inheritDoc
     */
    public function notFound(KeyValuePendingGetResponseModel $responseModel): ViewModel
    {
        return new HttpResponseViewModel(response_error(
            $responseModel->getEntity(),
            'Unable to find requested pending consul key value',
            Response::HTTP_NOT_FOUND,
        ));
    }

    // @codeCoverageIgnoreStart

    /**
     * @inheritDoc
     */
    public function internalServerError(KeyValuePendingGetResponseModel $responseModel, Throwable $throwable): ViewModel
    {
        if (config('app.debug')) {
            throw $throwable;
        }
        return new HttpResponseViewModel(response_error(
            $throwable,
            'Unable to retrieve information for pending consul key value',
            Response::HTTP_INTERNAL_SERVER_ERROR,
        ));
    }

    // @codeCoverageIgnoreEnd
}
