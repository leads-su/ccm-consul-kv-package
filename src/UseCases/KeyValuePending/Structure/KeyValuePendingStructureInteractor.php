<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Structure;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Consul\KeyValue\Interfaces\KeyValuePendingRepositoryInterface;

/**
 * Class KeyValuePendingStructureInteractor
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\Structure
 */
class KeyValuePendingStructureInteractor implements KeyValuePendingStructureInputPort
{
    /**
     * Output port instance
     * @var KeyValuePendingStructureOutputPort
     */
    private KeyValuePendingStructureOutputPort $output;

    /**
     * Key Value repository instance
     * @var KeyValuePendingRepositoryInterface
     */
    private KeyValuePendingRepositoryInterface $repository;

    /**
     * KeyValuePendingStructureInteractor constructor.
     * @param KeyValuePendingStructureOutputPort $output
     * @param KeyValuePendingRepositoryInterface $repository
     * @return void
     */
    public function __construct(KeyValuePendingStructureOutputPort $output, KeyValuePendingRepositoryInterface $repository)
    {
        $this->output = $output;
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function structure(KeyValuePendingStructureRequestModel $requestModel): ViewModel
    {
        $namespaced = $this->repository->allNamespaced();
        $structure = [];

        foreach ($namespaced as $namespace => $keys) {
            if (!array_key_exists($namespace, $structure)) {
                $structure[$namespace] = [];
            }
            foreach ($keys as $key) {
                $newKey = explode('/', $key);
                unset($newKey[count($newKey) - 1]);
                $newKey = implode('/', $newKey) . '/';
                if (!in_array($newKey, $structure[$namespace])) {
                    $structure[$namespace][] = $newKey;
                }
            }
        }

        try {
            return $this->output->structure(new KeyValuePendingStructureResponseModel(
                $structure
            ));
            // @codeCoverageIgnoreStart
        } catch (Throwable $exception) {
            return $this->output->internalServerError(
                new KeyValuePendingStructureResponseModel(),
                $exception
            );
        }
        // @codeCoverageIgnoreEnd
    }
}
