<?php

namespace Zeus\Provider;

use Illuminate\Support\ServiceProvider;

class ZeusServiceProvider extends ServiceProvider
{

    public function register()
    {
        //
    }

    public function boot()
    {
        \View::addNamespace('zeus', base_path('zeus/App/Views'));
        \View::addNamespace('zeus_dashboard', base_path('zeus_config/Dashboard'));
    }
}
