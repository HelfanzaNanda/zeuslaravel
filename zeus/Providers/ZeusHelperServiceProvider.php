<?php

namespace Zeus\Provider;

use Illuminate\Support\ServiceProvider;

class ZeusHelperServiceProvider extends ServiceProvider
{
    public function register()
    {
        foreach (glob(base_path('zeus/Helpers/*.php')) as $file) {
            require_once($file);
        }
    }

    public function boot()
    {
        //
    }
}
