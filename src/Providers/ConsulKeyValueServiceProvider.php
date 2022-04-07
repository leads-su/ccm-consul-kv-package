<?php

namespace ConsulConfigManager\Consul\KeyValue\Providers;

use Illuminate\Support\Facades\Route;
use Spatie\EventSourcing\Facades\Projectionist;
use ConsulConfigManager\Consul\KeyValue\Commands;
use ConsulConfigManager\Consul\KeyValue\Reactors;
use ConsulConfigManager\Consul\KeyValue\Services;
use ConsulConfigManager\Consul\KeyValue\UseCases;
use ConsulConfigManager\Consul\KeyValue\Interfaces;
use ConsulConfigManager\Consul\KeyValue\Presenters;
use ConsulConfigManager\Consul\KeyValue\Projectors;
use ConsulConfigManager\Consul\KeyValue\Repositories;
use ConsulConfigManager\Domain\DomainServiceProvider;
use ConsulConfigManager\Consul\KeyValue\Http\Controllers;
use ConsulConfigManager\Consul\KeyValue\ConsulKeyValueDomain;

/**
 * Class ConsulKeyValueServiceProvider
 * @package ConsulConfigManager\Consul\KeyValue\Providers
 */
class ConsulKeyValueServiceProvider extends DomainServiceProvider
{
    /**
     * List of commands provided by package
     * @var array
     */
    protected array $packageCommands = [
        Commands\KeyValueSync::class,
        Commands\KeyValueApply::class,
    ];

    /**
     * List of repositories provided by package
     * @var array
     */
    protected array $packageRepositories = [
        Interfaces\KeyValueRepositoryInterface::class          =>  Repositories\KeyValueRepository::class,
        Interfaces\KeyValuePendingRepositoryInterface::class   =>  Repositories\KeyValuePendingRepository::class,
    ];

    /**
     * @inheritDoc
     */
    public function register(): void
    {
        $this->registerConfiguration();
        parent::register();
    }

    /**
     * @inheritDoc
     */
    public function boot(): void
    {
        $this->registerRoutes();
        $this->offerPublishing();
        $this->registerMigrations();
        $this->registerCommands();
        parent::boot();
    }


    /**
     * Register package configuration
     * @return void
     */
    protected function registerConfiguration(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/config.php',
            'consul.kv'
        );
    }

    /**
     * Register package migrations
     * @return void
     */
    protected function registerMigrations(): void
    {
        if (ConsulKeyValueDomain::shouldRunMigrations()) {
            $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        }
    }

    /**
     * Register package routes
     * @return void
     */
    protected function registerRoutes(): void
    {
        if (ConsulKeyValueDomain::shouldRegisterRoutes()) {
            Route::prefix(config('consul.kv.prefix'))
                ->middleware(config('consul.kv.middleware'))
                ->group(function (): void {
                    $this->loadRoutesFrom(__DIR__ . '/../../routes/routes.php');
                });
        }
    }

    /**
     * Register package commands
     * @return void
     */
    protected function registerCommands(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands($this->packageCommands);
        }
    }

    /**
     * Offer resources for publishing
     * @return void
     */
    protected function offerPublishing(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../../config/config.php'        =>  config_path('consul/kv.php'),
            ], ['ccm-consul-kv-configuration', 'ccm-consul-kv']);
            $this->publishes([
                __DIR__ . '/../../database/migrations'      =>  database_path('migrations'),
            ], ['ccm-consul-kv-migrations', 'ccm-consul-kv']);
        }
    }

    /**
     * @inheritDoc
     */
    protected function registerFactories(): void
    {
    }

    /**
     * @inheritDoc
     */
    protected function registerRepositories(): void
    {
        foreach ($this->packageRepositories as $abstract => $concrete) {
            $this->app->bind($abstract, $concrete);
        }
    }

    /**
     * @inheritDoc
     */
    protected function registerInterceptors(): void
    {
        $this->registerKeyValueInterceptors();
        $this->registerKeyValuePendingInterceptors();
    }

    /**
     * Register KeyValue interceptors
     * @return void
     */
    private function registerKeyValueInterceptors(): void
    {
        $this->registerInterceptorFromParameters(
            UseCases\KeyValue\Namespaced\KeyValueNamespacedInputPort::class,
            UseCases\KeyValue\Namespaced\KeyValueNamespacedInteractor::class,
            Controllers\KeyValue\KeyValueNamespacedController::class,
            Presenters\KeyValue\KeyValueNamespacedHttpPresenter::class,
        );

        $this->registerInterceptorFromParameters(
            UseCases\KeyValue\References\KeyValueReferencesInputPort::class,
            UseCases\KeyValue\References\KeyValueReferencesInteractor::class,
            Controllers\KeyValue\KeyValueReferencesController::class,
            Presenters\KeyValue\KeyValueReferencesHttpPresenter::class,
        );

        $this->registerInterceptorFromParameters(
            UseCases\KeyValue\Get\KeyValueGetInputPort::class,
            UseCases\KeyValue\Get\KeyValueGetInteractor::class,
            Controllers\KeyValue\KeyValueGetController::class,
            Presenters\KeyValue\KeyValueGetHttpPresenter::class,
        );

        $this->registerInterceptorFromParameters(
            UseCases\KeyValue\Menu\KeyValueMenuInputPort::class,
            UseCases\KeyValue\Menu\KeyValueMenuInteractor::class,
            Controllers\KeyValue\KeyValueMenuController::class,
            Presenters\KeyValue\KeyValueMenuHttpPresenter::class,
        );

        $this->registerInterceptorFromParameters(
            UseCases\KeyValue\Structure\KeyValueStructureInputPort::class,
            UseCases\KeyValue\Structure\KeyValueStructureInteractor::class,
            Controllers\KeyValue\KeyValueStructureController::class,
            Presenters\KeyValue\KeyValueStructureHttpPresenter::class,
        );

        $this->registerInterceptorFromParameters(
            UseCases\KeyValue\Create\KeyValueCreateInputPort::class,
            UseCases\KeyValue\Create\KeyValueCreateInteractor::class,
            Controllers\KeyValue\KeyValueCreateController::class,
            Presenters\KeyValue\KeyValueCreateHttpPresenter::class,
        );

        $this->registerInterceptorFromParameters(
            UseCases\KeyValue\Update\KeyValueUpdateInputPort::class,
            UseCases\KeyValue\Update\KeyValueUpdateInteractor::class,
            Controllers\KeyValue\KeyValueUpdateController::class,
            Presenters\KeyValue\KeyValueUpdateHttpPresenter::class,
        );

        $this->registerInterceptorFromParameters(
            UseCases\KeyValue\Delete\KeyValueDeleteInputPort::class,
            UseCases\KeyValue\Delete\KeyValueDeleteInteractor::class,
            Controllers\KeyValue\KeyValueDeleteController::class,
            Presenters\KeyValue\KeyValueDeleteHttpPresenter::class,
        );
    }

    /**
     * Register KeyValuePending interceptors
     * @return void
     */
    private function registerKeyValuePendingInterceptors(): void
    {
        $this->registerInterceptorFromParameters(
            UseCases\KeyValuePending\List\KeyValuePendingListInputPort::class,
            UseCases\KeyValuePending\List\KeyValuePendingListInteractor::class,
            Controllers\KeyValuePending\KeyValuePendingListController::class,
            Presenters\KeyValuePending\KeyValuePendingListHttpPresenter::class,
        );

        $this->registerInterceptorFromParameters(
            UseCases\KeyValuePending\Get\KeyValuePendingGetInputPort::class,
            UseCases\KeyValuePending\Get\KeyValuePendingGetInteractor::class,
            Controllers\KeyValuePending\KeyValuePendingGetController::class,
            Presenters\KeyValuePending\KeyValuePendingGetHttpPresenter::class,
        );

        $this->registerInterceptorFromParameters(
            UseCases\KeyValuePending\Create\KeyValuePendingCreateInputPort::class,
            UseCases\KeyValuePending\Create\KeyValuePendingCreateInteractor::class,
            Controllers\KeyValuePending\KeyValuePendingCreateController::class,
            Presenters\KeyValuePending\KeyValuePendingCreateHttpPresenter::class,
        );

        $this->registerInterceptorFromParameters(
            UseCases\KeyValuePending\Update\KeyValuePendingUpdateInputPort::class,
            UseCases\KeyValuePending\Update\KeyValuePendingUpdateInteractor::class,
            Controllers\KeyValuePending\KeyValuePendingUpdateController::class,
            Presenters\KeyValuePending\KeyValuePendingUpdateHttpPresenter::class,
        );

        $this->registerInterceptorFromParameters(
            UseCases\KeyValuePending\Delete\KeyValuePendingDeleteInputPort::class,
            UseCases\KeyValuePending\Delete\KeyValuePendingDeleteInteractor::class,
            Controllers\KeyValuePending\KeyValuePendingDeleteController::class,
            Presenters\KeyValuePending\KeyValuePendingDeleteHttpPresenter::class,
        );

        $this->registerInterceptorFromParameters(
            UseCases\KeyValuePending\Menu\KeyValuePendingMenuInputPort::class,
            UseCases\KeyValuePending\Menu\KeyValuePendingMenuInteractor::class,
            Controllers\KeyValuePending\KeyValuePendingMenuController::class,
            Presenters\KeyValuePending\KeyValuePendingMenuHttpPresenter::class,
        );

        $this->registerInterceptorFromParameters(
            UseCases\KeyValuePending\Structure\KeyValuePendingStructureInputPort::class,
            UseCases\KeyValuePending\Structure\KeyValuePendingStructureInteractor::class,
            Controllers\KeyValuePending\KeyValuePendingStructureController::class,
            Presenters\KeyValuePending\KeyValuePendingStructureHttpPresenter::class,
        );
    }

    /**
     * @inheritDoc
     */
    protected function registerServices(): void
    {
        $this->app->bind(Interfaces\KeyValueServiceInterface::class, Services\KeyValueService::class);
    }

    /**
     * @inheritDoc
     */
    protected function registerReactors(): void
    {
        Projectionist::addReactors([
            Reactors\KeyValue\KeyValueReactorNewCreated::class,
            Reactors\KeyValue\KeyValueReactorExistingUpdated::class,
            Reactors\KeyValue\KeyValueReactorExistingDeleted::class,
        ]);
    }

    /**
     * @inheritDoc
     */
    protected function registerProjectors(): void
    {
        Projectionist::addProjectors([
            Projectors\KeyValueProjector::class,
            Projectors\KeyValuePendingProjector::class,
        ]);
    }
}
