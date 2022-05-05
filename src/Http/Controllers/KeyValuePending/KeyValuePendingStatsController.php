<?php

namespace ConsulConfigManager\Consul\KeyValue\Http\Controllers\KeyValuePending;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Stats\KeyValuePendingStatsInputPort;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Stats\KeyValuePendingStatsRequestModel;

/**
 * Class KeyValuePendingStatsController
 * @package ConsulConfigManager\Consul\KeyValue\Http\Controllers\KeyValuePending
 */
class KeyValuePendingStatsController extends Controller
{
    /**
     * Key Value Read input port interactor instance
     * @var KeyValuePendingStatsInputPort
     */
    private KeyValuePendingStatsInputPort $interactor;

    /**
     * ServiceController constructor.
     * @param KeyValuePendingStatsInputPort $interactor
     * @return void
     */
    public function __construct(KeyValuePendingStatsInputPort $interactor)
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
        $viewModel = $this->interactor->stats(
            new KeyValuePendingStatsRequestModel($request)
        );

        if ($viewModel instanceof HttpResponseViewModel) {
            return $viewModel->getResponse();
        }

        return null;
    }

    // @codeCoverageIgnoreEnd
}
