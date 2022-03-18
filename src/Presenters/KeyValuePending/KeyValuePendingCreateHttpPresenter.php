<?php

namespace ConsulConfigManager\Consul\KeyValue\Presenters\KeyValuePending;

use Throwable;
use Illuminate\Http\Response;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Create\KeyValuePendingCreateOutputPort;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Create\KeyValuePendingCreateResponseModel;

/**
 * Class KeyValuePendingCreateHttpPresenter
 * @package ConsulConfigManager\Consul\KeyValue\Presenters\KeyValuePending
 */
class KeyValuePendingCreateHttpPresenter implements KeyValuePendingCreateOutputPort
{
    /**
     * @inheritDoc
     */
    public function create(KeyValuePendingCreateResponseModel $responseModel): ViewModel
    {
        return new HttpResponseViewModel(response_success(
            $responseModel->getEntity(),
            'Successfully created new pending consul key value',
            Response::HTTP_CREATED,
        ));
    }

    // @codeCoverageIgnoreStart

    /**
     * @inheritDoc
     */
    public function internalServerError(KeyValuePendingCreateResponseModel $responseModel, Throwable $throwable): ViewModel
    {
        if (config('app.debug')) {
            throw $throwable;
        }
        return new HttpResponseViewModel(response_error(
            $throwable,
            'Unable to create new pending consul key value',
            Response::HTTP_INTERNAL_SERVER_ERROR,
        ));
    }

    // @codeCoverageIgnoreEnd
}
