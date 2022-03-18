<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Get;

use Throwable;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use ConsulConfigManager\Consul\KeyValue\Interfaces\KeyValueRepositoryInterface;

/**
 * Class KeyValueGetInteractor
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\Get
 */
class KeyValueGetInteractor implements KeyValueGetInputPort
{
    /**
     * Output port instance
     * @var KeyValueGetOutputPort
     */
    private KeyValueGetOutputPort $output;

    /**
     * Key Value repository instance
     * @var KeyValueRepositoryInterface
     */
    private KeyValueRepositoryInterface $repository;

    /**
     * KeyValueGetInteractor constructor.
     * @param KeyValueGetOutputPort $output
     * @param KeyValueRepositoryInterface $repository
     * @return void
     */
    public function __construct(KeyValueGetOutputPort $output, KeyValueRepositoryInterface $repository)
    {
        $this->output = $output;
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function read(KeyValueGetRequestModel $requestModel): ViewModel
    {
        $key = $requestModel->getKey();

        try {
            $model = $this->repository->findOrFail($key);
            $modelArray = $model->toArray();
            if ($model->reference) {
                Arr::set($modelArray, 'reference', $model->resolveReferencePath($model->value));
            }

            Arr::set($modelArray, 'changelog', $model->history());

            // @codeCoverageIgnoreStart
            $requestUser = $requestModel->getRequest()->user();
            if ($requestUser) {
                $canView = $requestUser->hasPermissionTo('consul kv view value');
            } else {
                $canView = false;
            }
            // @codeCoverageIgnoreEnd

            if (!$canView) {
                $dottedArray = Arr::dot($modelArray);
                $dottedChangelogArray = Arr::dot(Arr::get($modelArray, 'changelog'));

                foreach ($dottedArray as $key => $value) {
                    if (Str::endsWith($key, 'value')) {
                        $dottedArray[$key] = Str::repeat('*', 8);
                    }
                }

                foreach ($dottedChangelogArray as $key => $value) {
                    if (Str::endsWith($key, 'value')) {
                        $dottedChangelogArray[$key] = Str::repeat('*', 8);
                    }
                }

                foreach ($dottedArray as $key => $value) {
                    Arr::set($modelArray, $key, $value);
                }

                foreach ($dottedChangelogArray as $key => $value) {
                    Arr::set($modelArray, 'changelog.' . $key, $value);
                }
            }

            return $this->output->read(new KeyValueGetResponseModel(
                $modelArray
            ));
        } catch (Throwable $exception) {
            if ($exception instanceof ModelNotFoundException) {
                return $this->output->keyNotFound(new KeyValueGetResponseModel());
            }
            // @codeCoverageIgnoreStart
            return $this->output->internalServerError(new KeyValueGetResponseModel(), $exception);
            // @codeCoverageIgnoreEnd
        }
    }
}
