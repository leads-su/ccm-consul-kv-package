<?php

namespace ConsulConfigManager\Consul\KeyValue\Http\Controllers\KeyValuePending;

use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Create\KeyValuePendingCreateInputPort;
use ConsulConfigManager\Consul\KeyValue\Http\Requests\KeyValuePending\KeyValuePendingCreateUpdateRequest;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Create\KeyValuePendingCreateRequestModel;

/**
 * Class KeyValuePendingCreateController
 * @package ConsulConfigManager\Consul\KeyValue\Http\Controllers\KeyValuePending
 */
class KeyValuePendingCreateController extends Controller
{
    /**
     * Input port interactor instance
     * @var KeyValuePendingCreateInputPort
     */
    private KeyValuePendingCreateInputPort $interactor;

    /**
     * KeyValuePendingCreateController constructor.
     * @param KeyValuePendingCreateInputPort $interactor
     * @return void
     */
    public function __construct(KeyValuePendingCreateInputPort $interactor)
    {
        $this->interactor = $interactor;
    }

    // @codeCoverageIgnoreStart

    /**
     * Handle incoming request
     * @param KeyValuePendingCreateUpdateRequest $request
     * @return Response|null
     */
    public function __invoke(KeyValuePendingCreateUpdateRequest $request): ?Response
    {
        $viewModel = $this->interactor->create(
            new KeyValuePendingCreateRequestModel($request)
        );

        if ($viewModel instanceof HttpResponseViewModel) {
            return $viewModel->getResponse();
        }

        return null;
    }

    // @codeCoverageIgnoreEnd
}
