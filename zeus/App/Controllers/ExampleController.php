<?php

namespace Zeus\App\Controllers;

use Zeus\App\Controllers\ZeusController;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Zeus\Libraries\Test;

class ExampleController extends ZeusController
{
    /**
     * Call view
     * return view('zeus::example');
     * return view('zeus::folder.example');
     */

    /** 
     * Call Helper
     * date_now() // Check zeus/Helpers
     */

    public function index()
    {
        return view('zeus::example');
    }
}