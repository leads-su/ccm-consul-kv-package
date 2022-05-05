<?php

namespace ConsulConfigManager\Consul\KeyValue\Presenters\KeyValuePending;

use Throwable;
use Illuminate\Http\Response;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Update\KeyValuePendingUpdateOutputPort;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Update\KeyValuePendingUpdateResponseModel;

/**
 * Class KeyValuePendingUpdateHttpPresenter
 * @package ConsulConfigManager\Consul\KeyValue\Presenters\KeyValuePending
 */
class KeyValuePendingUpdateHttpPresenter implements KeyValuePendingUpdateOutputPort
{
    /**
     * @inheritDoc
     */
    public function update(KeyValuePendingUpdateResponseModel $responseModel): ViewModel
    {
        return new HttpResponseViewModel(response_success(
            $responseModel->getEntity(),
            'Successfully update pending consul key value',
            Response::HTTP_OK,
        ));
    }

    /**
     * @inheritDoc
     */
    public function notFound(KeyValuePendingUpdateResponseModel $responseModel): ViewModel
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
    public function internalServerError(KeyValuePendingUpdateResponseModel $responseModel, Throwable $throwable): ViewModel
    {
        if (config('app.debug')) {
            throw $throwable;
        }
        return new HttpResponseViewModel(response_error(
            $throwable,
            'Unable to update pending consul key value',
            Response::HTTP_INTERNAL_SERVER_ERROR,
        ));
    }

    // @codeCoverageIgnoreEnd
}
