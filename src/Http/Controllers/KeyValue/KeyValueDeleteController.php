<?php

namespace ConsulConfigManager\Consul\KeyValue\Http\Controllers\KeyValue;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Delete\KeyValueDeleteInputPort;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Delete\KeyValueDeleteRequestModel;

/**
 * Class KeyValueDeleteController
 * @package ConsulConfigManager\Consul\KeyValue\Http\Controllers\KeyValue
 */
class KeyValueDeleteController extends Controller
{
    /**
     * Input port interactor instance
     * @var KeyValueDeleteInputPort
     */
    private KeyValueDeleteInputPort $interactor;

    /**
     * KeyValueDeleteController constructor.
     * @param KeyValueDeleteInputPort $interactor
     * @return void
     */
    public function __construct(KeyValueDeleteInputPort $interactor)
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
            new KeyValueDeleteRequestModel($request, $identifier)
        );

        if ($viewModel instanceof HttpResponseViewModel) {
            return $viewModel->getResponse();
        }

        return null;
    }

    // @codeCoverageIgnoreEnd
}
