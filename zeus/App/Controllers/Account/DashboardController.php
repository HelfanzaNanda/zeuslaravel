<?php

namespace Zeus\App\Controllers\Account;

use Zeus\App\Controllers\ZeusController;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class DashboardController extends ZeusController
{

    public function index()
    {
        $role= user_role_name();
        $role_value= user_role_value();
        return zeus_view('zeus_dashboard::'.$role, ['title' => 'Dashboard '. $role_value]);
    }
}