<?php

namespace Modules\Item\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Item\Events\Handlers\RegisterItemSidebar;

class ItemServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration;
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
        $this->app['events']->listen(BuildingSidebar::class, RegisterItemSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('rarities', array_dot(trans('item::rarities')));
            $event->load('types', array_dot(trans('item::types')));
            $event->load('items', array_dot(trans('item::items')));
            // append translations



        });
    }

    public function boot()
    {
        $this->publishConfig('item', 'permissions');

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

    private function registerBindings()
    {
        $this->app->bind(
            'Modules\Item\Repositories\RarityRepository',
            function () {
                $repository = new \Modules\Item\Repositories\Eloquent\EloquentRarityRepository(new \Modules\Item\Entities\Rarity());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Item\Repositories\Cache\CacheRarityDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Item\Repositories\TypeRepository',
            function () {
                $repository = new \Modules\Item\Repositories\Eloquent\EloquentTypeRepository(new \Modules\Item\Entities\Type());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Item\Repositories\Cache\CacheTypeDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Item\Repositories\ItemRepository',
            function () {
                $repository = new \Modules\Item\Repositories\Eloquent\EloquentItemRepository(new \Modules\Item\Entities\Item());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Item\Repositories\Cache\CacheItemDecorator($repository);
            }
        );
// add bindings



    }
}
