<?php

namespace Zeus\App\Controllers\User;

use Zeus\App\Controllers\ZeusController;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Zeus\Libraries\ZeusSecurity;
use Zeus\Libraries\ZeusUser;
use Zeus\Libraries\ZeusUserGroup;
use Illuminate\Http\Request;
use Route;

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

    public function access($id)
    {
        $group = new ZeusUserGroup();
        $info = $group->group_info($id);
        if (empty($info->id)) {
            return redirect()->route('core.user.group')->with('error', 'Data not found');
        }

        return zeus_view('zeus::user.group.access', ['title' => 'Access User Group'], compact('info'));
    }

    public function show_modules(Request $request)
    {
        if($request->ajax())
        {
            $zeus_group = new ZeusUserGroup();
            $user_group_id=$request->group;
            $info = $zeus_group->group_info($user_group_id);
            $user_group_name=$info->meta_key;
            $not_allowed = array('login', 'core', '_ignition', '', 'api');
            $routeCollection = Route::getRoutes();
            $route_includes = collect();
            
            $route_name_access= $zeus_group->zeus_user_group_access($user_group_name);
            // dd($route_name_access);
            foreach ($routeCollection as $route) {
                $uri = $route->uri();
                $explode = explode("/", $uri);
                if (!in_array($explode[0], $not_allowed)) {
                    $route_name = $route->action['as'];
                    $route_prefix = $route->action['prefix'];
                    $route_action = $route->action['controller'];
                    $explode_function = explode("@", $route_action);

                    $module_label = ucwords($uri);
                    if (!empty($route_prefix)) {
                        $module_label = str_replace("/", " ", $route_prefix);
                        $module_label = ucwords($module_label);
                    }
                    $access=0;
                    if(isset($route_name_access[$route_name]))
                    {
                        if($route_name_access[$route_name] == 'on')
                        {
                            $access=1;
                        }
                    }
                    $route_includes->push([
                        'label' => $module_label,
                        'function' => $explode_function[1],
                        'uri' => $uri,
                        'name' => $route_name,
                        'prefix' => $route_prefix,
                        'controller' => $route_action,
                        'access'=> $access
                    ]);
                }
            }
            $with_prefix = $route_includes->groupBy('prefix');
            $array_modules=$with_prefix->toArray();
            
            $view=view('zeus::user.group.access_data',compact('array_modules', 'user_group_id'));
            echo $view->render();
        }else{
            die('Not ajax request');
        }
    }

    public function save_access(Request $request)
    {
        if($request->ajax())
        {
            $zeus_group = new ZeusUserGroup();
            $user_group_id = $request->id;
            $info = $zeus_group->group_info($user_group_id);
            $user_group_name = $info->meta_key;
            $data=$request->item;
            $action=$zeus_group->zeus_user_group_access_update($user_group_name, $data);
            if($action==true)
            {
                return response()->json(array('status'=>true));
            }else{
                return response()->json(array('status' => false,'message'=>'System Error'));
            }
        }else{
            die('Not ajax request');
        }
    }

}