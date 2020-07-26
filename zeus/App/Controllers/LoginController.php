<?php

namespace Zeus\App\Controllers;

use Zeus\App\Controllers\ZeusController;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Zeus\Libraries\ZeusSecurity;
use Zeus\Libraries\ZeusUser;
use Illuminate\Http\Request;

class LoginController extends ZeusController
{

    public function index()
    {
        $user = new ZeusUser();
        if ($user->has_login()) 
        {
            return redirect()->route('core.account.dashboard');
        }
        return view('zeus::layout.login');
    }

    public function signin(Request $request)
    {
        if($request->ajax())
        {
            $validator = \Validator::make($request->all(), [
                'user_text'    =>  'required',
                'password'    =>  'required'
            ]);
            
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation Error'
                ]);
            }

            $user=new ZeusUser();
            $check_login=$user->login($request->user_text,$request->password);
            return response()->json($check_login);
        }else{
            die('Not ajax request');
        }
    }
}
