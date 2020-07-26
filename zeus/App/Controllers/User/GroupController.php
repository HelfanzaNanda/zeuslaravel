<?php

namespace Zeus\App\Controllers\User;

use Zeus\App\Controllers\ZeusController;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Zeus\Libraries\ZeusSecurity;
use Zeus\Libraries\ZeusUser;
use Zeus\Libraries\ZeusUserGroup;
use Illuminate\Http\Request;

class GroupController extends ZeusController
{

    public function index()
    {
        $group=new ZeusUserGroup();
        $data=$group->groups();
        // dd($data);
        return zeus_view('zeus::user.group.index', ['title' => 'User Group'],compact('data'));
    }

    public function store(Request $request)
    {
        if($request->ajax())
        {
            $name=$request->name;
            $key=$request->key;
            $group=new ZeusUserGroup();
            $save=$group->group_add($name, $key);
            if($save)
            {
                return response()->json([
                    'status'=>true,
                    'message'=>'Successfully added user group'
                ]);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'Failed add user group'
                ]);
            }
        }else {
            die('Not ajax request');
        }
    }

    public function delete($id)
    {
        $group = new ZeusUserGroup();
        $info = $group->group_info($id);
        if(empty($info->id))
        {
            return redirect()->route('core.user.group')->with('error','Data not found');
        }
        $key=$info->meta_key;
        if($key == 'superadmin')
        {
            return redirect()->route('core.user.group')->with('error', 'Data not found');
        }

        $delete=$group->group_delete($key);
        // dd($key);
        if($delete)
        {
            return redirect()->route('core.user.group')->with('success', 'Successfully deleted user group');
        }else{
            return redirect()->route('core.user.group')->with('error', 'Data not found');
        }
    }

}