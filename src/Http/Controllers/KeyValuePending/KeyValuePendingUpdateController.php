<?php

namespace ConsulConfigManager\Consul\KeyValue\Http\Controllers\KeyValuePending;

use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Update\KeyValuePendingUpdateInputPort;
use ConsulConfigManager\Consul\KeyValue\Http\Requests\KeyValuePending\KeyValuePendingCreateUpdateRequest;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Update\KeyValuePendingUpdateRequestModel;

/**
 * Class KeyValuePendingUpdateController
 * @package ConsulConfigManager\Consul\KeyValue\Http\Controllers\KeyValuePending
 */
class KeyValuePendingUpdateController extends Controller
{
    /**
     * Input port interactor instance
     * @var KeyValuePendingUpdateInputPort
     */
    private KeyValuePendingUpdateInputPort $interactor;

    /**
     * KeyValuePendingUpdateController constructor.
     * @param KeyValuePendingUpdateInputPort $interactor
     * @return void
     */
    public function __construct(KeyValuePendingUpdateInputPort $interactor)
    {
        $this->interactor = $interactor;
    }

    /**
     * Handle incoming request
     * @param KeyValuePendingCreateUpdateRequest $request
     * @return Response|null
     */
    public function __invoke(KeyValuePendingCreateUpdateRequest $request): ?Response
    {
        $viewModel = $this->interactor->update(
            new KeyValuePendingUpdateRequestModel($request)
        );

        if ($viewModel instanceof HttpResponseViewModel) {
            return $viewModel->getResponse();
        }

        return null;
    }

    // @codeCoverageIgnoreEnd
}
