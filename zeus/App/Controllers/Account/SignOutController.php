<?php

namespace Zeus\App\Controllers\Account;

use Zeus\App\Controllers\ZeusController;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Zeus\Libraries\ZeusUser;

class SignOutController extends ZeusController
{

    public function index()
    {
        $user=new ZeusUser();
        $user->logout();
        return redirect()->route('login');
    }
}
