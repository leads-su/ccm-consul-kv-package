<?php

namespace ConsulConfigManager\Consul\KeyValue\Http\Controllers\KeyValue\Directory;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Directory\DirectoryGetContentsInputPort;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Directory\DirectoryGetContentsRequestModel;

/**
 * Class DirectoryGetContentsController
 * @package ConsulConfigManager\Consul\KeyValue\Http\Controllers\KeyValue\Directory
 */
class DirectoryGetContentsController extends Controller
{
    /**
     * Input port interactor instance
     * @var DirectoryGetContentsInputPort
     */
    private DirectoryGetContentsInputPort $interactor;

    /**
     * DirectoryGetContentsController constructor.
     * @param DirectoryGetContentsInputPort $interactor
     * @return void
     */
    public function __construct(DirectoryGetContentsInputPort $interactor)
    {
        $this->interactor = $interactor;
    }

    // @codeCoverageIgnoreStart

    /**
     * Handle incoming request
     * @param Request $request
     * @param string $path
     * @return Response|null
     */
    public function __invoke(Request $request, string $path): ?Response
    {
        $viewModel = $this->interactor->get(
            new DirectoryGetContentsRequestModel($request, $path)
        );

        if ($viewModel instanceof HttpResponseViewModel) {
            return $viewModel->getResponse();
        }

        return null;
    }

    // @codeCoverageIgnoreEnd
}