<?php

namespace ConsulConfigManager\Consul\KeyValue\Providers;

use Illuminate\Support\Facades\Route;
use Spatie\EventSourcing\Facades\Projectionist;
use ConsulConfigManager\Consul\KeyValue\UseCases;
use ConsulConfigManager\Consul\KeyValue\Presenters;
use ConsulConfigManager\Domain\DomainServiceProvider;
use ConsulConfigManager\Consul\KeyValue\Http\Controllers;
use ConsulConfigManager\Consul\Agent\Commands\KeyValueSync;
use ConsulConfigManager\Consul\KeyValue\ConsulKeyValueDomain;
use ConsulConfigManager\Consul\KeyValue\Services\KeyValueService;
use ConsulConfigManager\Consul\KeyValue\Projectors\KeyValueProjector;
use ConsulConfigManager\Consul\KeyValue\Repositories\KeyValueRepository;
use ConsulConfigManager\Consul\KeyValue\Interfaces\KeyValueServiceInterface;
use ConsulConfigManager\Consul\KeyValue\Interfaces\KeyValueRepositoryInterface;

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
        KeyValueSync::class,
    ];

    /**
     * List of repositories provided by package
     * @var array
     */
    protected array $packageRepositories = [
        KeyValueRepositoryInterface::class      =>  KeyValueRepository::class,
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
        $this->registerInterceptorFromParameters(
            UseCases\Namespaced\KeyValueNamespacedInputPort::class,
            UseCases\Namespaced\KeyValueNamespacedInteractor::class,
            Controllers\KeyValueNamespacedController::class,
            Presenters\KeyValueNamespacedHttpPresenter::class,
        );

        $this->registerInterceptorFromParameters(
            UseCases\References\KeyValueReferencesInputPort::class,
            UseCases\References\KeyValueReferencesInteractor::class,
            Controllers\KeyValueReferencesController::class,
            Presenters\KeyValueReferencesHttpPresenter::class,
        );

        $this->registerInterceptorFromParameters(
            UseCases\Get\KeyValueGetInputPort::class,
            UseCases\Get\KeyValueGetInteractor::class,
            Controllers\KeyValueGetController::class,
            Presenters\KeyValueGetHttpPresenter::class,
        );
    }

    /**
     * @inheritDoc
     */
    protected function registerServices(): void
    {
        $this->app->bind(KeyValueServiceInterface::class, KeyValueService::class);
    }

    /**
     * @inheritDoc
     */
    protected function registerReactors(): void
    {
    }

    /**
     * @inheritDoc
     */
    protected function registerProjectors(): void
    {
        Projectionist::addProjectors([
            KeyValueProjector::class,
        ]);
    }
}
