<?php

namespace ConsulConfigManager\Consul\KeyValue\Http\Controllers\KeyValue;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Menu\KeyValueMenuInputPort;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Menu\KeyValueMenuRequestModel;

/**
 * Class KeyValueMenuController
 * @package ConsulConfigManager\Consul\KeyValue\Http\Controllers
 */
class KeyValueMenuController extends Controller
{
    /**
     * Key Value Read input port interactor instance
     * @var KeyValueMenuInputPort
     */
    private KeyValueMenuInputPort $interactor;

    /**
     * ServiceController constructor.
     * @param KeyValueMenuInputPort $interactor
     * @return void
     */
    public function __construct(KeyValueMenuInputPort $interactor)
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
            new KeyValueMenuRequestModel($request)
        );

        if ($viewModel instanceof HttpResponseViewModel) {
            return $viewModel->getResponse();
        }

        return null;
    }

    // @codeCoverageIgnoreEnd
}
