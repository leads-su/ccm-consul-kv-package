<?php

namespace ConsulConfigManager\Consul\KeyValue\Http\Controllers\KeyValue;

use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Create\KeyValueCreateInputPort;
use ConsulConfigManager\Consul\KeyValue\Http\Requests\KeyValue\KeyValueCreateUpdateRequest;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Create\KeyValueCreateRequestModel;

/**
 * Class KeyValueCreateController
 * @package ConsulConfigManager\Consul\KeyValue\Http\Controllers\KeyValue
 */
class KeyValueCreateController extends Controller
{
    /**
     * Input port interactor instance
     * @var KeyValueCreateInputPort
     */
    private KeyValueCreateInputPort $interactor;

    /**
     * KeyValueCreateController constructor.
     * @param KeyValueCreateInputPort $interactor
     * @return void
     */
    public function __construct(KeyValueCreateInputPort $interactor)
    {
        $this->interactor = $interactor;
    }

    // @codeCoverageIgnoreStart

    /**
     * Handle incoming request
     * @param KeyValueCreateUpdateRequest $request
     * @return Response|null
     */
    public function __invoke(KeyValueCreateUpdateRequest $request): ?Response
    {
        $viewModel = $this->interactor->create(
            new KeyValueCreateRequestModel($request)
        );

        if ($viewModel instanceof HttpResponseViewModel) {
            return $viewModel->getResponse();
        }

        return null;
    }

    // @codeCoverageIgnoreEnd
}
