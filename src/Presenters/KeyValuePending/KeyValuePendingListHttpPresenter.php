<?php

namespace ConsulConfigManager\Consul\KeyValue\Presenters\KeyValuePending;

use Throwable;
use Illuminate\Http\Response;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\List\KeyValuePendingListOutputPort;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\List\KeyValuePendingListResponseModel;

/**
 * Class KeyValuePendingListHttpPresenter
 * @package ConsulConfigManager\Consul\KeyValue\Presenters\KeyValuePending
 */
class KeyValuePendingListHttpPresenter implements KeyValuePendingListOutputPort
{
    /**
     * @inheritDoc
     */
    public function list(KeyValuePendingListResponseModel $responseModel): ViewModel
    {
        return new HttpResponseViewModel(response_success(
            $responseModel->getEntities(),
            'Successfully fetched list of pending consul key values',
            Response::HTTP_OK,
        ));
    }

    // @codeCoverageIgnoreStart

    /**
     * @inheritDoc
     */
    public function internalServerError(KeyValuePendingListResponseModel $responseModel, Throwable $throwable): ViewModel
    {
        if (config('app.debug')) {
            throw $throwable;
        }
        return new HttpResponseViewModel(response_error(
            $throwable,
            'Unable to fetch list of pending consul key values',
            Response::HTTP_INTERNAL_SERVER_ERROR,
        ));
    }

    // @codeCoverageIgnoreEnd
}
