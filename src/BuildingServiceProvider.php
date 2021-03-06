<?php

namespace Metrique\Building;

use Illuminate\Support\ServiceProvider;
use Metrique\Building\Commands\BuildingMigrationsCommand;
use Metrique\Building\Commands\BuildingSeedsCommand;
use Metrique\Building\Contracts\BlockRepositoryInterface;
use Metrique\Building\Repositories\BlockRepositoryEloquent;
use Metrique\Building\Contracts\Block\StructureRepositoryInterface;
use Metrique\Building\Repositories\Block\StructureRepositoryEloquent;
use Metrique\Building\Contracts\Block\TypeRepositoryInterface;
use Metrique\Building\Repositories\Block\TypeRepositoryEloquent;
use Metrique\Building\Contracts\PageRepositoryInterface;
use Metrique\Building\Repositories\PageRepositoryEloquent;
use Metrique\Building\Contracts\Page\ContentRepositoryInterface;
use Metrique\Building\Repositories\Page\ContentRepositoryEloquent;
use Metrique\Building\Contracts\Page\GroupRepositoryInterface;
use Metrique\Building\Repositories\Page\GroupRepositoryEloquent;
use Metrique\Building\Contracts\Page\SectionRepositoryInterface;
use Metrique\Building\Repositories\Page\SectionRepositoryEloquent;

class BuildingServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    // protected $defer = true;

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        // Commands
        $this->commands('command.metrique.migrate-building');
        $this->commands('command.metrique.seed-building');

        // Views
        $this->loadViewsFrom(__DIR__.'/Resources/views/', 'metrique-building');

        $this->publishes([
            __DIR__.'/Resources/views' => base_path('resources/views/vendor/metrique-building'),
        ], 'building');
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Facade
        $this->registerBuildingFacade();

        // Repositories
        $this->registerBlocks();
        $this->registerPages();

        // Commands
        $this->registerCommands();
    }

    /**
     * Register the Building Facade.
     */
    private function registerBuildingFacade()
    {
        $this->app->bind('\Metrique\Building\Building', function () {
            return new Building($this->app);
        });
    }

    private function registerBlocks()
    {
        // Block
        $this->app->bind(
            BlockRepositoryInterface::class,
            BlockRepositoryEloquent::class
        );

        // Block type
        $this->app->bind(
            TypeRepositoryInterface::class,
            TypeRepositoryEloquent::class
        );

        // Block structure
        $this->app->bind(
            StructureRepositoryInterface::class,
            StructureRepositoryEloquent::class
        );
    }

    private function registerPages()
    {
        // Page
        $this->app->bind(
            PageRepositoryInterface::class,
            PageRepositoryEloquent::class
        );

        // Page contents
        $this->app->bind(
            ContentRepositoryInterface::class,
            ContentRepositoryEloquent::class
        );

        // Page sections
        $this->app->bind(
            SectionRepositoryInterface::class,
            SectionRepositoryEloquent::class
        );

        // Page sections
        $this->app->bind(
            GroupRepositoryInterface::class,
            GroupRepositoryEloquent::class
        );
    }

    /**
     * Register the artisan commands.
     */
    private function registerCommands()
    {
        $this->app->singleton('command.metrique.migrate-building', function ($app) {
            return new BuildingMigrationsCommand();
        });

        $this->app->singleton('command.metrique.seed-building', function ($app) {
            return new BuildingSeedsCommand();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            // 'Metrique\Building\Contracts\BlockTypeRepositoryInterface',
            // 'Metrique\Building\Repositories\BlockTypeRepositoryEloquent'
        ];
    }
}
