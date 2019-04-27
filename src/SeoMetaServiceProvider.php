<?php

namespace Xcalder\SeoMeta;

use Illuminate\Support\ServiceProvider;
use SeoMeta\Factory;

class SeoMetaServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {

    }
    
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;
    
    /*
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../migrate');
    }
    */

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Factory::class, function ($app) {
            return new SeoMetaManager($app);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [Factory::class];
    }
}
