<?php

namespace ConsulConfigManager\Consul\KeyValue\Http\Controllers\KeyValue\Directory;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Directory\DirectoryListKeysInputPort;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Directory\DirectoryListKeysRequestModel;

/**
 * Class DirectoryListKeysController
 * @package ConsulConfigManager\Consul\KeyValue\Http\Controllers\KeyValue\Directory
 */
class DirectoryListKeysController extends Controller
{
    /**
     * Input port interactor instance
     * @var DirectoryListKeysInputPort
     */
    private DirectoryListKeysInputPort $interactor;

    /**
     * DirectoryListKeysController constructor.
     * @param DirectoryListKeysInputPort $interactor
     * @return void
     */
    public function __construct(DirectoryListKeysInputPort $interactor)
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
        $viewModel = $this->interactor->list(
            new DirectoryListKeysRequestModel($request, $path)
        );

        if ($viewModel instanceof HttpResponseViewModel) {
            return $viewModel->getResponse();
        }

        return null;
    }

    // @codeCoverageIgnoreEnd
}
