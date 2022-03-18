<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Menu;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Consul\KeyValue\Helpers\MenuBuilderHelper;
use ConsulConfigManager\Consul\KeyValue\Interfaces\KeyValueRepositoryInterface;

/**
 * Class KeyValueMenuInteractor
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\Menu
 */
class KeyValueMenuInteractor implements KeyValueMenuInputPort
{
    /**
     * Output port instance
     * @var KeyValueMenuOutputPort
     */
    private KeyValueMenuOutputPort $output;

    /**
     * Repository instance
     * @var KeyValueRepositoryInterface
     */
    private KeyValueRepositoryInterface $repository;

    /**
     * KeyValueMenuInteractor constructor.
     * @param KeyValueMenuOutputPort $output
     * @param KeyValueRepositoryInterface $repository
     * @return void
     */
    public function __construct(KeyValueMenuOutputPort $output, KeyValueRepositoryInterface $repository)
    {
        $this->output = $output;
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function menu(KeyValueMenuRequestModel $requestModel): ViewModel
    {
        try {
            return $this->output->menu(new KeyValueMenuResponseModel(
                MenuBuilderHelper::keyValueTree($this->repository)
            ));
            // @codeCoverageIgnoreStart
        } catch (Throwable $throwable) {
            return $this->output->internalServerError(new KeyValueMenuResponseModel(), $throwable);
        }
        // @codeCoverageIgnoreEnd
    }
}
