<?php

namespace ConsulConfigManager\Consul\KeyValue\Http\Controllers\KeyValuePending;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Get\KeyValuePendingGetInputPort;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Get\KeyValuePendingGetRequestModel;

/**
 * Class KeyValuePendingGetController
 * @package ConsulConfigManager\Consul\KeyValue\Http\Controllers\KeyValuePending
 */
class KeyValuePendingGetController extends Controller
{
    /**
     * Input port interactor instance
     * @var KeyValuePendingGetInputPort
     */
    private KeyValuePendingGetInputPort $interactor;

    /**
     * ServiceController constructor.
     * @param KeyValuePendingGetInputPort $interactor
     * @return void
     */
    public function __construct(KeyValuePendingGetInputPort $interactor)
    {
        $this->interactor = $interactor;
    }

    // @codeCoverageIgnoreStart

    /**
     * Handle incoming request
     * @param Request $request
     * @param string $key
     * @return Response|null
     */
    public function __invoke(Request $request, string $key): ?Response
    {
        $viewModel = $this->interactor->get(
            new KeyValuePendingGetRequestModel($request, $key)
        );

        if ($viewModel instanceof HttpResponseViewModel) {
            return $viewModel->getResponse();
        }

        return null;
    }

    // @codeCoverageIgnoreEnd
}
