<?php

namespace ConsulConfigManager\Consul\KeyValue\Http\Controllers\KeyValuePending;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Structure\KeyValuePendingStructureInputPort;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Structure\KeyValuePendingStructureRequestModel;

/**
 * Class KeyValuePendingStructureController
 * @package ConsulConfigManager\Consul\KeyValue\Http\Controllers
 */
class KeyValuePendingStructureController extends Controller
{
    /**
     * Key Value Read input port interactor instance
     * @var KeyValuePendingStructureInputPort
     */
    private KeyValuePendingStructureInputPort $interactor;

    /**
     * ServiceController constructor.
     * @param KeyValuePendingStructureInputPort $interactor
     * @return void
     */
    public function __construct(KeyValuePendingStructureInputPort $interactor)
    {
        $this->interactor = $interactor;
    }

    // @codeCoverageIgnoreStart

    /**
     * Handle incoming request
     * @param Request $request
     * @return Response|null
     */
    public function __invoke(Request $request): ?Response
    {
        $viewModel = $this->interactor->structure(
            new KeyValuePendingStructureRequestModel($request)
        );

        if ($viewModel instanceof HttpResponseViewModel) {
            return $viewModel->getResponse();
        }

        return null;
    }

    // @codeCoverageIgnoreEnd
}
