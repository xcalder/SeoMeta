<?php

namespace Xcalder\SeoMeta\Facades;

use Illuminate\Support\Facades\Facade;

class SeoMeta extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'SeoMeta';
    }
}
