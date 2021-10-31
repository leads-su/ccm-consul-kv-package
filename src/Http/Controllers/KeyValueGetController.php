<?php

namespace ConsulConfigManager\Consul\KeyValue\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Consul\KeyValue\UseCases\Get\KeyValueGetInputPort;
use ConsulConfigManager\Consul\KeyValue\UseCases\Get\KeyValueGetRequestModel;

/**
 * Class KeyValueGetController
 * @package ConsulConfigManager\Consul\KeyValue\Http\Controllers
 */
class KeyValueGetController extends Controller
{
    /**
     * Key Value Read input port interactor instance
     * @var KeyValueGetInputPort
     */
    private KeyValueGetInputPort $interactor;

    /**
     * ServiceController constructor.
     * @param KeyValueGetInputPort $interactor
     * @return void
     */
    public function __construct(KeyValueGetInputPort $interactor)
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
        $viewModel = $this->interactor->read(
            new KeyValueGetRequestModel($request, $key)
        );

        if ($viewModel instanceof HttpResponseViewModel) {
            return $viewModel->getResponse();
        }

        return null;
    }

    // @codeCoverageIgnoreEnd
}
