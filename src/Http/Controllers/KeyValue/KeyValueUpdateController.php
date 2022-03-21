<?php

namespace ConsulConfigManager\Consul\KeyValue\Http\Controllers\KeyValue;

use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Update\KeyValueUpdateInputPort;
use ConsulConfigManager\Consul\KeyValue\Http\Requests\KeyValue\KeyValueCreateUpdateRequest;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Update\KeyValueUpdateRequestModel;

/**
 * Class KeyValueUpdateController
 * @package ConsulConfigManager\Consul\KeyValue\Http\Controllers\KeyValue
 */
class KeyValueUpdateController extends Controller
{
    /**
     * Input port interactor instance
     * @var KeyValueUpdateInputPort
     */
    private KeyValueUpdateInputPort $interactor;

    /**
     * KeyValueUpdateController constructor.
     * @param KeyValueUpdateInputPort $interactor
     * @return void
     */
    public function __construct(KeyValueUpdateInputPort $interactor)
    {
        $this->interactor = $interactor;
    }

    // @codeCoverageIgnoreStart

    /**
     * Handle incoming request
     * @param KeyValueCreateUpdateRequest $request
     * @return Response|null
     */
    public function __invoke(KeyValueCreateUpdateRequest $request): ?Response
    {
        $viewModel = $this->interactor->update(
            new KeyValueUpdateRequestModel($request)
        );

        if ($viewModel instanceof HttpResponseViewModel) {
            return $viewModel->getResponse();
        }

        return null;
    }

    // @codeCoverageIgnoreEnd
}
