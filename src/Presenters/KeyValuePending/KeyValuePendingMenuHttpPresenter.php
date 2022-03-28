<?php

namespace ConsulConfigManager\Consul\KeyValue\Presenters\KeyValuePending;

use Throwable;
use Illuminate\Http\Response;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Menu\KeyValuePendingMenuOutputPort;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Menu\KeyValuePendingMenuResponseModel;
use function config;
use function response_error;
use function response_success;

/**
 * Class KeyValuePendingMenuHttpPresenter
 * @package ConsulConfigManager\Consul\KeyValue\Presenters
 */
class KeyValuePendingMenuHttpPresenter implements KeyValuePendingMenuOutputPort
{
    /**
     * @inheritDoc
     */
    public function menu(KeyValuePendingMenuResponseModel $responseModel): ViewModel
    {
        return new HttpResponseViewModel(response_success(
            $responseModel->getEntities(),
            'Successfully generated menu for KV Store of pending values',
            Response::HTTP_OK,
        ));
    }

    // @codeCoverageIgnoreStart
    /**
     * @inheritDoc
     */
    public function internalServerError(KeyValuePendingMenuResponseModel $responseModel, Throwable $throwable): ViewModel
    {
        if (config('app.debug')) {
            throw $throwable;
        }
        return new HttpResponseViewModel(response_error(
            $throwable,
            'Unable to generate menu for KV Store of pending values',
            Response::HTTP_INTERNAL_SERVER_ERROR,
        ));
    }
    // @codeCoverageIgnoreEnd
}
