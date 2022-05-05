<?php

namespace ConsulConfigManager\Consul\KeyValue\Http\Controllers\KeyValuePending;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\List\KeyValuePendingListInputPort;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\List\KeyValuePendingListRequestModel;

/**
 * Class KeyValuePendingListController
 * @package ConsulConfigManager\Consul\KeyValue\Http\Controllers\KeyValuePending
 */
class KeyValuePendingListController extends Controller
{
    /**
     * Input port interactor instance
     * @var KeyValuePendingListInputPort
     */
    private KeyValuePendingListInputPort $interactor;

    /**
     * KeyValuePendingListController constructor.
     * @param KeyValuePendingListInputPort $interactor
     * @return void
     */
    public function __construct(KeyValuePendingListInputPort $interactor)
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
        $viewModel = $this->interactor->list(
            new KeyValuePendingListRequestModel($request)
        );

        if ($viewModel instanceof HttpResponseViewModel) {
            return $viewModel->getResponse();
        }

        return null;
    }

    // @codeCoverageIgnoreEnd
}
