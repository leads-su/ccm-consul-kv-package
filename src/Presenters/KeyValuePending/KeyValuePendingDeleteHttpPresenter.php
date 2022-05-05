<?php

namespace ConsulConfigManager\Consul\KeyValue\Presenters\KeyValuePending;

use Throwable;
use Illuminate\Http\Response;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Delete\KeyValuePendingDeleteOutputPort;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Delete\KeyValuePendingDeleteResponseModel;

/**
 * Class KeyValuePendingDeleteHttpPresenter
 * @package ConsulConfigManager\Consul\KeyValue\Presenters\KeyValuePending
 */
class KeyValuePendingDeleteHttpPresenter implements KeyValuePendingDeleteOutputPort
{
    /**
     * @inheritDoc
     */
    public function delete(KeyValuePendingDeleteResponseModel $responseModel): ViewModel
    {
        return new HttpResponseViewModel(response_success(
            $responseModel->getEntity(),
            'Successfully deleted pending consul key value',
            Response::HTTP_OK,
        ));
    }

    /**
     * @inheritDoc
     */
    public function notFound(KeyValuePendingDeleteResponseModel $responseModel): ViewModel
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
    public function internalServerError(KeyValuePendingDeleteResponseModel $responseModel, Throwable $throwable): ViewModel
    {
        if (config('app.debug')) {
            throw $throwable;
        }
        return new HttpResponseViewModel(response_error(
            $throwable,
            'Unable to delete pending consul key value',
            Response::HTTP_INTERNAL_SERVER_ERROR,
        ));
    }

    // @codeCoverageIgnoreEnd
}
