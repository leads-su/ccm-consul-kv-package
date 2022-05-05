<?php

namespace ConsulConfigManager\Consul\KeyValue\Http\Controllers\KeyValue;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Stats\KeyValueStatsInputPort;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Stats\KeyValueStatsRequestModel;

/**
 * Class KeyValueStatsController
 * @package ConsulConfigManager\Consul\KeyValue\Http\Controllers\KeyValue
 */
class KeyValueStatsController extends Controller
{
    /**
     * Key Value Read input port interactor instance
     * @var KeyValueStatsInputPort
     */
    private KeyValueStatsInputPort $interactor;

    /**
     * ServiceController constructor.
     * @param KeyValueStatsInputPort $interactor
     * @return void
     */
    public function __construct(KeyValueStatsInputPort $interactor)
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
            new KeyValueStatsRequestModel($request)
        );

        if ($viewModel instanceof HttpResponseViewModel) {
            return $viewModel->getResponse();
        }

        return null;
    }

    // @codeCoverageIgnoreEnd
}
