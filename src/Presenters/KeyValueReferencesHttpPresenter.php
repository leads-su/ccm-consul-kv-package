<?php

namespace ConsulConfigManager\Consul\KeyValue\Presenters;

use Throwable;
use Illuminate\Http\Response;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Consul\KeyValue\UseCases\References\KeyValueReferencesOutputPort;
use ConsulConfigManager\Consul\KeyValue\UseCases\References\KeyValueReferencesResponseModel;

/**
 * Class KeyValueReferencesHttpPresenter
 * @package ConsulConfigManager\Consul\KeyValue\Presenters
 */
class KeyValueReferencesHttpPresenter implements KeyValueReferencesOutputPort
{
    /**
     * @inheritDoc
     */
    public function references(KeyValueReferencesResponseModel $responseModel): ViewModel
    {
        return new HttpResponseViewModel(response_success(
            $responseModel->getReferences(),
            'Successfully fetched list of references',
            Response::HTTP_OK,
        ));
    }

    // @codeCoverageIgnoreStart
    /**
     * @inheritDoc
     */
    public function internalServerError(KeyValueReferencesResponseModel $responseModel, Throwable $exception): ViewModel
    {
        if (config('app.debug')) {
            throw $exception;
        }
        return new HttpResponseViewModel(response_error(
            $exception,
            'Unable to retrieve references list'
        ));
    }
    // @codeCoverageIgnoreEnd
}
