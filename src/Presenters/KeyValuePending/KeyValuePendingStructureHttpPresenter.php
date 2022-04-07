<?php

namespace ConsulConfigManager\Consul\KeyValue\Presenters\KeyValuePending;

use Throwable;
use function config;
use function response_error;
use Illuminate\Http\Response;
use function response_success;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Structure\KeyValuePendingStructureOutputPort;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Structure\KeyValuePendingStructureResponseModel;

/**
 * Class KeyValuePendingStructureHttpPresenter
 * @package ConsulConfigManager\Consul\KeyValue\Presenters
 */
class KeyValuePendingStructureHttpPresenter implements KeyValuePendingStructureOutputPort
{
    /**
     * @inheritDoc
     */
    public function structure(KeyValuePendingStructureResponseModel $responseModel): ViewModel
    {
        return new HttpResponseViewModel(response_success(
            $responseModel->getEntities(),
            'Successfully generated structure for KV Store of pending values',
            Response::HTTP_OK,
        ));
    }

    // @codeCoverageIgnoreStart
    /**
     * @inheritDoc
     */
    public function internalServerError(KeyValuePendingStructureResponseModel $responseModel, Throwable $throwable): ViewModel
    {
        if (config('app.debug')) {
            throw $throwable;
        }
        return new HttpResponseViewModel(response_error(
            $throwable,
            'Unable to generate structure for KV Store of pending values',
            Response::HTTP_INTERNAL_SERVER_ERROR,
        ));
    }
    // @codeCoverageIgnoreEnd
}
