<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Menu;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Consul\KeyValue\Helpers\MenuBuilderHelper;
use ConsulConfigManager\Consul\KeyValue\Interfaces\KeyValuePendingRepositoryInterface;

/**
 * Class KeyValuePendingMenuInteractor
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\Menu
 */
class KeyValuePendingMenuInteractor implements KeyValuePendingMenuInputPort
{
    /**
     * Output port instance
     * @var KeyValuePendingMenuOutputPort
     */
    private KeyValuePendingMenuOutputPort $output;

    /**
     * Repository instance
     * @var KeyValuePendingRepositoryInterface
     */
    private KeyValuePendingRepositoryInterface $repository;

    /**
     * KeyValuePendingMenuInteractor constructor.
     * @param KeyValuePendingMenuOutputPort $output
     * @param KeyValuePendingRepositoryInterface $repository
     * @return void
     */
    public function __construct(KeyValuePendingMenuOutputPort $output, KeyValuePendingRepositoryInterface $repository)
    {
        $this->output = $output;
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function menu(KeyValuePendingMenuRequestModel $requestModel): ViewModel
    {
        try {
            return $this->output->menu(new KeyValuePendingMenuResponseModel(
                MenuBuilderHelper::keyValueTree($this->repository)
            ));
            // @codeCoverageIgnoreStart
        } catch (Throwable $throwable) {
            return $this->output->internalServerError(new KeyValuePendingMenuResponseModel(), $throwable);
        }
        // @codeCoverageIgnoreEnd
    }
}
