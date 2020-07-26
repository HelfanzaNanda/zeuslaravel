<?php

namespace Zeus\App\Controllers\Account;

use Zeus\App\Controllers\ZeusController;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class DashboardController extends ZeusController
{

    public function index()
    {
        
        return zeus_view("");
    }
}