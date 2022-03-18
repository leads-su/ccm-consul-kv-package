<?php

namespace ConsulConfigManager\Consul\KeyValue\Presenters\KeyValue;

use Throwable;
use Illuminate\Http\Response;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Namespaced\KeyValueNamespacedOutputPort;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Namespaced\KeyValueNamespacedResponseModel;

/**
 * Class KeyValueNamespacedHttpPresenter
 * @package ConsulConfigManager\Consul\KeyValue\Presenters\KeyValue
 */
class KeyValueNamespacedHttpPresenter implements KeyValueNamespacedOutputPort
{
    /**
     * @inheritDoc
     */
    public function namespaced(KeyValueNamespacedResponseModel $responseModel): ViewModel
    {
        return new HttpResponseViewModel(response_success(
            $responseModel->getNamespaced(),
            'Successfully fetched namespaced keys',
            Response::HTTP_OK,
        ));
    }

    // @codeCoverageIgnoreStart
    /**
     * @inheritDoc
     */
    public function internalServerError(KeyValueNamespacedResponseModel $responseModel, Throwable $exception): ViewModel
    {
        if (config('app.debug')) {
            throw $exception;
        }
        return new HttpResponseViewModel(response_error(
            $exception,
            'Unable to retrieve namespaced keys',
            Response::HTTP_INTERNAL_SERVER_ERROR,
        ));
    }
    // @codeCoverageIgnoreEnd
}
