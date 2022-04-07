<?php

namespace ConsulConfigManager\Consul\KeyValue\Presenters\KeyValue;

use Throwable;
use function config;
use function response_error;
use Illuminate\Http\Response;
use function response_success;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Menu\KeyValueMenuOutputPort;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Menu\KeyValueMenuResponseModel;

/**
 * Class KeyValueMenuHttpPresenter
 * @package ConsulConfigManager\Consul\KeyValue\Presenters
 */
class KeyValueMenuHttpPresenter implements KeyValueMenuOutputPort
{
    /**
     * @inheritDoc
     */
    public function menu(KeyValueMenuResponseModel $responseModel): ViewModel
    {
        return new HttpResponseViewModel(response_success(
            $responseModel->getEntities(),
            'Successfully generated menu for KV Store',
            Response::HTTP_OK,
        ));
    }

    // @codeCoverageIgnoreStart
    /**
     * @inheritDoc
     */
    public function internalServerError(KeyValueMenuResponseModel $responseModel, Throwable $throwable): ViewModel
    {
        if (config('app.debug')) {
            throw $throwable;
        }
        return new HttpResponseViewModel(response_error(
            $throwable,
            'Unable to generate menu for KV Store',
            Response::HTTP_INTERNAL_SERVER_ERROR,
        ));
    }
    // @codeCoverageIgnoreEnd
}
