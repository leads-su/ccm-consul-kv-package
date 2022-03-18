<?php

namespace ConsulConfigManager\Consul\KeyValue\Http\Controllers\KeyValuePending;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Delete\KeyValuePendingDeleteInputPort;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Delete\KeyValuePendingDeleteRequestModel;

/**
 * Class KeyValuePendingDeleteController
 * @package ConsulConfigManager\Consul\KeyValue\Http\Controllers\KeyValuePending
 */
class KeyValuePendingDeleteController extends Controller
{
    /**
     * Input port interactor instance
     * @var KeyValuePendingDeleteInputPort
     */
    private KeyValuePendingDeleteInputPort $interactor;

    /**
     * KeyValuePendingDeleteController constructor.
     * @param KeyValuePendingDeleteInputPort $interactor
     * @return void
     */
    public function __construct(KeyValuePendingDeleteInputPort $interactor)
    {
        $this->interactor = $interactor;
    }

    // @codeCoverageIgnoreStart

    /**
     * Handle incoming request
     * @param Request $request
     * @param string $identifier
     * @return Response|null
     */
    public function __invoke(Request $request, string $identifier): ?Response
    {
        $viewModel = $this->interactor->delete(
            new KeyValuePendingDeleteRequestModel($request, $identifier)
        );

        if ($viewModel instanceof HttpResponseViewModel) {
            return $viewModel->getResponse();
        }

        return null;
    }

    // @codeCoverageIgnoreEnd
}
