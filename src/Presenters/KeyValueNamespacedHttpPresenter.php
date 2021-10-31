<?php

namespace ConsulConfigManager\Consul\KeyValue\Presenters;

use Throwable;
use Illuminate\Http\Response;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Consul\KeyValue\UseCases\Namespaced\KeyValueNamespacedOutputPort;
use ConsulConfigManager\Consul\KeyValue\UseCases\Namespaced\KeyValueNamespacedResponseModel;

/**
 * Class KeyValueNamespacedHttpPresenter
 * @package ConsulConfigManager\Consul\KeyValue\Presenters
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
            'Unable to retrieve namespaced keys'
        ));
    }
}
