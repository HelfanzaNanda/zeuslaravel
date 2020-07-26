<?php

namespace Zeus\App\Controllers\Account;

use Zeus\App\Controllers\ZeusController;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Zeus\Libraries\ZeusSecurity;
use Zeus\Libraries\ZeusUser;
use Illuminate\Http\Request;

class ProfileController extends ZeusController
{

    public function index()
    {        
        return zeus_view('zeus::account.profile',['title'=>'User Profile']);
    }

    public function profile_update(Request $request)
    {
        if($request->ajax())
        {
            $validator = \Validator::make($request->all(), [
                'name'    =>  'required',
                'email'    =>  'required',
            ]);
            
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validator->errors()
                ]);
            }

            $user_id=user_info('id');
            $full_name=$request->name;
            $email=$request->email;
            $password_old=$request->p1;
            $password_new = $request->p2;
            $password_new_confirm = $request->p3;

            $user=new ZeusUser();
            $save=$user->user_profile_update($user_id,$full_name,$email,$password_old,$password_new, $password_new_confirm);
            return response()->json($save);

        }else{
            die('Not ajax request');
        }
    }

    public function avatar_update(Request $request)
    {
        if($request->ajax())
        {
            $validator = \Validator::make($request->all(), [
                'file'    =>  'required'
            ]);
            
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validator->errors()
                ]);
            }
            
            $user_id=user_info('id');
            $user=new ZeusUser();

            
            if($request->hasFile('file'))
            {
                $destionation_path=public_path("uploads/avatar");
                $file = $request->file('file');
                $extension=$file->getClientOriginalExtension();
                $file_name="avatar-".$user_id.".".$extension;
                if($file->move($destionation_path, $file_name))
                {
                    $save=$user->user_avatar_update($user_id,$file_name);
                    if($save)
                    {
                        return response()->json([
                            'status' => true,
                            'img'=>user_avatar(),
                            'message' => 'Successfully updated avatar'
                        ]);
                    }else{
                        return response()->json([
                            'status' => false,
                            'message' => 'Server Error'
                        ]);
                    }
                }else{
                    return response()->json([
                        'status' => false,
                        'message' => 'Avatar not be upload'
                    ]);
                }
            }else{
                return response()->json([
                    'status'=>false,
                    'message'=>'Upload not is file'
                ]);
            }
            
        }else{
            die('Not ajax request');
        }
    }
}