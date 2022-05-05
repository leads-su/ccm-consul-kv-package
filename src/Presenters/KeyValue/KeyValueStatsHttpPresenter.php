<?php

namespace ConsulConfigManager\Consul\KeyValue\Presenters\KeyValue;

use Throwable;
use Illuminate\Http\Response;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Stats\KeyValueStatsOutputPort;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Stats\KeyValueStatsResponseModel;

/**
 * Class KeyValueStatsHttpPresenter
 * @package ConsulConfigManager\Consul\KeyValue\Presenters\KeyValue
 */
class KeyValueStatsHttpPresenter implements KeyValueStatsOutputPort
{
    /**
     * @inheritDoc
     */
    public function stats(KeyValueStatsResponseModel $responseModel): ViewModel
    {
        return new HttpResponseViewModel(response_success(
            $responseModel->getEntities(),
            'Successfully fetched statistics for key value storage',
            Response::HTTP_OK
        ));
    }

    // @codeCoverageIgnoreStart
    /**
     * @inheritDoc
     */
    public function internalServerError(KeyValueStatsResponseModel $responseModel, Throwable $throwable): ViewModel
    {
        if (config('app.debug')) {
            throw $throwable;
        }
        return new HttpResponseViewModel(response_error(
            $throwable,
            'Unable to retrieve statistics for key value storage',
            Response::HTTP_INTERNAL_SERVER_ERROR,
        ));
    }
    // @codeCoverageIgnoreEnd
}
