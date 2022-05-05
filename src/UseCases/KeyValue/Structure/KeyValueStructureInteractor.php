<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Structure;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Consul\KeyValue\Interfaces\KeyValueRepositoryInterface;

/**
 * Class KeyValueStructureInteractor
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\Structure
 */
class KeyValueStructureInteractor implements KeyValueStructureInputPort
{
    /**
     * Output port instance
     * @var KeyValueStructureOutputPort
     */
    private KeyValueStructureOutputPort $output;

    /**
     * Key Value repository instance
     * @var KeyValueRepositoryInterface
     */
    private KeyValueRepositoryInterface $repository;

    /**
     * KeyValueStructureInteractor constructor.
     * @param KeyValueStructureOutputPort $output
     * @param KeyValueRepositoryInterface $repository
     * @return void
     */
    public function __construct(KeyValueStructureOutputPort $output, KeyValueRepositoryInterface $repository)
    {
        $this->output = $output;
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function structure(KeyValueStructureRequestModel $requestModel): ViewModel
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
            return $this->output->structure(new KeyValueStructureResponseModel(
                $structure
            ));
            // @codeCoverageIgnoreStart
        } catch (Throwable $exception) {
            return $this->output->internalServerError(
                new KeyValueStructureResponseModel(),
                $exception
            );
        }
        // @codeCoverageIgnoreEnd
    }
}
