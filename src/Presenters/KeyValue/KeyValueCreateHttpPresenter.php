<?php

namespace ConsulConfigManager\Consul\KeyValue\Presenters\KeyValue;

use Throwable;
use Illuminate\Http\Response;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Create\KeyValueCreateOutputPort;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Create\KeyValueCreateResponseModel;

/**
 * Class KeyValueCreateHttpPresenter
 * @package ConsulConfigManager\Consul\KeyValue\Presenters\KeyValue
 */
class KeyValueCreateHttpPresenter implements KeyValueCreateOutputPort
{
    /**
     * @inheritDoc
     */
    public function create(KeyValueCreateResponseModel $responseModel): ViewModel
    {
        return new HttpResponseViewModel(response_success(
            $responseModel->getEntity(),
            'Successfully created new consul key value',
            Response::HTTP_CREATED,
        ));
    }

    // @codeCoverageIgnoreStart

    /**
     * @inheritDoc
     */
    public function internalServerError(KeyValueCreateResponseModel $responseModel, Throwable $throwable): ViewModel
    {
        if (config('app.debug')) {
            throw $throwable;
        }
        return new HttpResponseViewModel(response_error(
            $throwable,
            'Unable to create new consul key value',
            Response::HTTP_INTERNAL_SERVER_ERROR,
        ));
    }

    // @codeCoverageIgnoreEnd
}
