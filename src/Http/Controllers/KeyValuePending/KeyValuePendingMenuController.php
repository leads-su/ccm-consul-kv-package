<?php

namespace ConsulConfigManager\Consul\KeyValue\Http\Controllers\KeyValuePending;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Menu\KeyValuePendingMenuInputPort;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Menu\KeyValuePendingMenuRequestModel;

/**
 * Class KeyValuePendingMenuController
 * @package ConsulConfigManager\Consul\KeyValue\Http\Controllers
 */
class KeyValuePendingMenuController extends Controller
{
    /**
     * Key Value Read input port interactor instance
     * @var KeyValuePendingMenuInputPort
     */
    private KeyValuePendingMenuInputPort $interactor;

    /**
     * ServiceController constructor.
     * @param KeyValuePendingMenuInputPort $interactor
     * @return void
     */
    public function __construct(KeyValuePendingMenuInputPort $interactor)
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
        $viewModel = $this->interactor->menu(
            new KeyValuePendingMenuRequestModel($request)
        );

        if ($viewModel instanceof HttpResponseViewModel) {
            return $viewModel->getResponse();
        }

        return null;
    }

    // @codeCoverageIgnoreEnd
}
