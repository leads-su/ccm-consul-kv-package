<?php

namespace ConsulConfigManager\Consul\KeyValue\Presenters\KeyValue;

use Throwable;
use Illuminate\Http\Response;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Delete\KeyValueDeleteOutputPort;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Delete\KeyValueDeleteResponseModel;

/**
 * Class KeyValueDeleteHttpPresenter
 * @package ConsulConfigManager\Consul\KeyValue\Presenters\KeyValue
 */
class KeyValueDeleteHttpPresenter implements KeyValueDeleteOutputPort
{
    /**
     * @inheritDoc
     */
    public function delete(KeyValueDeleteResponseModel $responseModel): ViewModel
    {
        return new HttpResponseViewModel(response_success(
            $responseModel->getEntity(),
            'Successfully deleted consul key value',
            Response::HTTP_OK,
        ));
    }

    /**
     * @inheritDoc
     */
    public function notFound(KeyValueDeleteResponseModel $responseModel): ViewModel
    {
        return new HttpResponseViewModel(response_error(
            $responseModel->getEntity(),
            'Unable to find requested consul key value',
            Response::HTTP_NOT_FOUND,
        ));
    }

    // @codeCoverageIgnoreStart

    /**
     * @inheritDoc
     */
    public function internalServerError(KeyValueDeleteResponseModel $responseModel, Throwable $throwable): ViewModel
    {
        if (config('app.debug')) {
            throw $throwable;
        }
        return new HttpResponseViewModel(response_error(
            $throwable,
            'Unable to delete consul key value',
            Response::HTTP_INTERNAL_SERVER_ERROR,
        ));
    }

    // @codeCoverageIgnoreEnd
}
