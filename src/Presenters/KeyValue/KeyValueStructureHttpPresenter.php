<?php

namespace ConsulConfigManager\Consul\KeyValue\Presenters\KeyValue;

use Throwable;
use Illuminate\Http\Response;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Structure\KeyValueStructureOutputPort;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Structure\KeyValueStructureResponseModel;
use function config;
use function response_error;
use function response_success;

/**
 * Class KeyValueStructureHttpPresenter
 * @package ConsulConfigManager\Consul\KeyValue\Presenters
 */
class KeyValueStructureHttpPresenter implements KeyValueStructureOutputPort
{
    /**
     * @inheritDoc
     */
    public function structure(KeyValueStructureResponseModel $responseModel): ViewModel
    {
        return new HttpResponseViewModel(response_success(
            $responseModel->getEntities(),
            'Successfully generated structure for KV Store',
            Response::HTTP_OK,
        ));
    }

    // @codeCoverageIgnoreStart
    /**
     * @inheritDoc
     */
    public function internalServerError(KeyValueStructureResponseModel $responseModel, Throwable $throwable): ViewModel
    {
        if (config('app.debug')) {
            throw $throwable;
        }
        return new HttpResponseViewModel(response_error(
            $throwable,
            'Unable to generate structure for KV Store',
            Response::HTTP_INTERNAL_SERVER_ERROR,
        ));
    }
    // @codeCoverageIgnoreEnd
}
