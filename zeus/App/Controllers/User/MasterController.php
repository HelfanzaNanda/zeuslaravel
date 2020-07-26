<?php

namespace Zeus\App\Controllers\User;

use Zeus\App\Controllers\ZeusController;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Zeus\Libraries\ZeusSecurity;
use Zeus\Libraries\ZeusUser;
use Zeus\Libraries\ZeusUserGroup;
use Zeus\App\Models\User;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;

class MasterController extends ZeusController
{
    private $group_id_superadmin=16;
    private $status=[0=>'Inactive',1=>'Active'];
    public function index()
    {
        $group_lib = new ZeusUserGroup();
        $group = $group_lib->groups();
        return zeus_view('zeus::user.master.index', ['title' => 'Users List'], compact('group'));
    }

    public function datatables(DataTables $dt, Request $request)
    {
        $user_table = 'zeus_user';
        $group_table = 'zeus_meta';

        $query = User::select($user_table . '.id as id', $user_table . '.name as nama', $group_table . '.meta_value as group', $user_table . '.email as email', $user_table . '.status as status')
        ->leftJoin($group_table . '', $user_table . '.user_group_id', '=', $group_table . '.id')
            ->where($user_table . '.user_group_id', '!=', $this->group_id_superadmin);
        if ($request->input('status') != '') {
            $query->where($user_table . '.status', $request->input('status'));
        }
        if (!empty($request->input('group'))) {
            $query->where($user_table . '.user_group_id', $request->input('group'));
        }
        return $dt->eloquent($query)
        ->addColumn('action', function ($u) {
            return '<a href="' . route('core.user.master.detail', array('id' => $u->id)) . '" class="btn btn-info btn-xs">Detail</a> 
                    <a onclick="return confirm(\'Are you sure delete user ' . $u->nama . '?\');" href="' . route('core.user.master.delete', array('id' => $u->id)) . '" class="btn btn-danger btn-xs">Delete</a> 
                    ';
        })
            ->editColumn('status', function ($u) {
                return strtr($u->status, $this->status);
            })
            ->toJson();
    }

    public function add()
    {
        $group_lib = new ZeusUserGroup();
        $group = $group_lib->groups();
        return zeus_view('zeus::user.master.add', ['title' => 'Add User'], compact('group'));
    }

    public function store(Request $request)
    {
        if($request->ajax())
        {
            $validator = \Validator::make($request->all(), [
                'group'    =>  'required',
                'full_name'    =>  'required',
                'username'    =>  'required',
                'email'    =>  'required',
                'p2'    =>  'required',
                'p3'    =>  'required',
            ]);
            
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validator->errors()
                ]);
            }

            $user_group_id = $request->group;
            $full_name = $request->full_name;
            $username = $request->username;
            $email = $request->email;
            $password_new = $request->p2;
            $password_new_confirm = $request->p3;
            $reload=$request->reload?1:0;

            $zeus=new ZeusUser();
            $save=$zeus->user_add($user_group_id, $full_name, $username, $email, $password_new, $password_new_confirm);
            if($save['status']==true)
            {
                return response()->json([
                    'status'=>true,
                    'message'=>$save['message'],
                    'reload'=>$reload
                ]);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => $save['message']
                ]);
            }
        }else{
            die('Not ajax request');
        }
    }

    public function detail($id)
    {
        $data=User::find($id);
        if(empty($data->id))
        {
            return redirect()->route('core.user.master')->with('error','User not found');
        }

        $group_lib = new ZeusUserGroup();
        $group = $group_lib->groups();
        $user_lib=new ZeusUser();
        $avatar=$user_lib->user_avatar($data->id);
        return zeus_view('zeus::user.master.detail', ['title' => 'User Detail'], compact('group','data','avatar'));
    }

    public function update(Request $request)
    {
        if ($request->ajax()) {
            $validator = \Validator::make($request->all(), [
                'id'    =>  'required',
                'name'    =>  'required',
                'email'    =>  'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validator->errors()
                ]);
            }

            $user_id =  $request->id;
            $full_name = $request->name;
            $email = $request->email;
            $password_old = $request->p1;
            $password_new = $request->p2;
            $password_new_confirm = $request->p3;
            $user_group_id=$request->group;

            $user = new ZeusUser();
            $save = $user->user_profile_update_admin($user_id, $full_name, $email, $user_group_id, $password_new, $password_new_confirm);
            return response()->json($save);
        } else {
            die('Not ajax request');
        }
    }

    public function delete($id)
    {
        $user = new ZeusUser();
        $delete = $user->user_delete($id);
        // dd($key);
        if ($delete['status']==true) {
            return redirect()->route('core.user.master')->with('success', 'Successfully deleted user');
        } else {
            return redirect()->route('core.user.master')->with('error', 'Data not found');
        }
    }

}