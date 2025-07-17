<?php

namespace ConsulConfigManager\Consul\KeyValue\Http\Controllers\KeyValue\Directory;

use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Consul\KeyValue\Http\Requests\KeyValue\DirectoryCreateRequest;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Directory\DirectoryCreateInputPort;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Directory\DirectoryCreateRequestModel;

/**
 * Class DirectoryCreateController
 * @package ConsulConfigManager\Consul\KeyValue\Http\Controllers\KeyValue\Directory
 */
class DirectoryCreateController extends Controller
{
    /**
     * Input port interactor instance
     * @var DirectoryCreateInputPort
     */
    private DirectoryCreateInputPort $interactor;

    /**
     * DirectoryCreateController constructor.
     * @param DirectoryCreateInputPort $interactor
     * @return void
     */
    public function __construct(DirectoryCreateInputPort $interactor)
    {
        $this->interactor = $interactor;
    }

    // @codeCoverageIgnoreStart

    /**
     * Handle incoming request
     * @param DirectoryCreateRequest $request
     * @return Response|null
     */
    public function __invoke(DirectoryCreateRequest $request): ?Response
    {
        $viewModel = $this->interactor->create(
            new DirectoryCreateRequestModel($request, $request->get('path'))
        );

        if ($viewModel instanceof HttpResponseViewModel) {
            return $viewModel->getResponse();
        }

        return null;
    }

    // @codeCoverageIgnoreEnd
}
