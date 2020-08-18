<?php

namespace Zeus\App\Controllers;

use Zeus\App\Controllers\ZeusController;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Zeus\Libraries\ZeusSecurity;
use Zeus\Libraries\ZeusUser;
use Illuminate\Http\Request;
use Session;

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

            $user = new ZeusUser();
            $check_login = $user->login($request->user_text, $request->password);
            return response()->json($check_login);
        }else{
            die('Not ajax request');
        }
    }

    public function send_verification(Request $request)
    {
        if ($request->ajax()) {
            $validator = \Validator::make($request->all(), [
                'email'    =>  'required'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation Error'
                ]);
            }

            
            $user = new ZeusUser();
            $check_forgot = $user->forgot_password($request->email);
            return response()->json($check_forgot);
        } else {
            die('Not ajax request');
        }
    }

    public function forgot_verified($token)
    {
        $user = new ZeusUser();
        $check_forgot = $user->forgot_token_validate($token);
        if($check_forgot['status']==true)
        {
            return redirect()->route('login.forgot.change_password');
        }else{
            return redirect()->route('login');
        }
    }

    public function change_password ()
    {
        if (Session::get('change_password')) {
            $user = new ZeusUser();
            $check_token = $user->forgot_token_validate(Session::get('change_password')['token']);
            if($check_token['status']==true)
            {
                return view('zeus::layout.change_password');
            }else{
                return redirect()->route('login');
            }
        }else{
            return redirect()->route('login');
        }
    }

    public function update_password(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'pass1'    =>  'required',
            'pass2'    =>  'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation Error'
            ]);
        }
        $pass1=$request->pass1;
        $pass2 = $request->pass2;
        if($pass1 != $pass2)
        {
            return response()->json([
                'status' => false,
                'message' => 'Confirmation Password not valid'
            ]);
        }
        $user = new ZeusUser();
        $action=$user->update_password_forgot($pass1);
        return response()->json($action);
    }
}
