<?php

namespace ConsulConfigManager\Consul\KeyValue\Http\Controllers\KeyValue;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Structure\KeyValueStructureInputPort;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Structure\KeyValueStructureRequestModel;

/**
 * Class KeyValueStructureController
 * @package ConsulConfigManager\Consul\KeyValue\Http\Controllers
 */
class KeyValueStructureController extends Controller
{
    /**
     * Key Value Read input port interactor instance
     * @var KeyValueStructureInputPort
     */
    private KeyValueStructureInputPort $interactor;

    /**
     * ServiceController constructor.
     * @param KeyValueStructureInputPort $interactor
     * @return void
     */
    public function __construct(KeyValueStructureInputPort $interactor)
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
            new KeyValueStructureRequestModel($request)
        );

        if ($viewModel instanceof HttpResponseViewModel) {
            return $viewModel->getResponse();
        }

        return null;
    }

    // @codeCoverageIgnoreEnd
}
