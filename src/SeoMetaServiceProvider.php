<?php

namespace Xcalder\SeoMeta;

use Illuminate\Support\ServiceProvider;

class SeoMetaServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(SeoMeta::class, function () {
            return new SeoMeta();
        });
    }
}
