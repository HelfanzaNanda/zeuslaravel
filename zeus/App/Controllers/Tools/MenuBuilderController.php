<?php

namespace Zeus\App\Controllers\Tools;

use Illuminate\Http\Request;
use Zeus\Libraries\ZeusMenu;
use Zeus\Libraries\ZeusUserGroup;
use Zeus\App\Controllers\ZeusController;

class MenuBuilderController extends ZeusController
{

    public function index()
    {
        $group_lib = new ZeusUserGroup();
        $group = $group_lib->groups();
        return zeus_view('zeus::tools.menu_builder.index', ['title' => 'Menu Builder'],compact('group'));
    }

    public function store(Request $request)
    {
        if($request->ajax())
        {
            $validator = \Validator::make($request->all(), [
                'title'    =>  'required',
                'icon'    =>  'required'
            ]);
            
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => print_r($validator->errors())
                ]);
            }

            $title=$request->title;
            $segment=isset($request->segment)? $request->segment:[];
            $icon=$request->icon;
            $route=$request->route;
            $group = $request->group;
            $menu_parent=$request->parent? $request->parent:NULL;

            $menu=new ZeusMenu();
            $save=$menu->create_menu($title, $segment, $icon, $route,[], $menu_parent, $group);
            return response()->json($save);
        }else{
            die('Not ajax request');
        }
    }

    public function menu_get(Request $request)
    {
        if ($request->ajax()) {
            $menu = new ZeusMenu();
            $show_admin=0;
            if($request->admin_show == true)
            {
                $show_admin=1;
            }
            $data = $menu->menu_data($show_admin);
            $view = view('zeus::tools.menu_builder.data', compact('data'));
            echo $view->render();
        } else {
            die('Not ajax request');
        }
    }

    public function menu_parent(Request $request)
    {
        if($request->ajax())
        {
            $menu = new ZeusMenu();
            $data=$menu->menu_parent($request->q,$request->menu_admin);
            return response()->json($data);
        }else{
            die('Not ajax request');
        }
    }

    public function confirm_delete(Request $request)
    {
        if ($request->ajax()) {
            $menu = new ZeusMenu();
            $data = $menu->menu_detail($request->id);
            $count_child=$menu->menu_has_child($request->id);
            $view = view('zeus::tools.menu_builder.delete', compact('data','count_child'));
            echo $view->render();
        } else {
            die('Not ajax request');
        }
    }

    public function menu_delete(Request $request)
    {
        if ($request->ajax()) {
            $menu = new ZeusMenu();
            $menu_id=$request->id;
            $delete_child=$request->child?TRUE:FALSE;
            $action= $menu->delete_menu($menu_id, $delete_child);
            return response()->json($action);
        } else {
            die('Not ajax request');
        }
    }

    public function confirm_edit(Request $request)
    {
        if ($request->ajax()) {
            $menu = new ZeusMenu();
            $data = $menu->menu_detail($request->id);

            $parent_name="";
            $parent_id=$data->zeus_menu_id;
            if(!empty($parent_id))
            {
                $data_parent=$menu->menu_detail($parent_id);
                $parent_name=$data_parent->title;
            }
            $count_child = $menu->menu_has_child($request->id);
            $group_lib = new ZeusUserGroup();
            $group = $group_lib->groups();
            // $access_menu=$menu->access_menu($request->id);
            // dd($access_menu);
            $access_menu=array();
            $view = view('zeus::tools.menu_builder.edit', compact('data', 'count_child', 'group', 'parent_name', 'access_menu'));
            echo $view->render();
        } else {
            die('Not ajax request');
        }
    }

    public function menu_edit(Request $request)
    {
        if ($request->ajax()) {
            $validator = \Validator::make($request->all(), [
                'id'    =>  'required',
                'title'    =>  'required',
                'icon'    =>  'required'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => print_r($validator->errors())
                ]);
            }

            $menu_id = $request->id;
            $title = $request->title;
            $segment = isset($request->segment) ? $request->segment : [];
            $icon = $request->icon;
            $route = $request->route;
            $group = $request->group;
            // $menu_parent = $request->parent ? $request->parent : NULL;

            $menu = new ZeusMenu();
            $save = $menu->edit_menu($menu_id, $title, $segment, $icon, $route, [], $group);
            return response()->json($save);
        } else {
            die('Not ajax request');
        }
    }

    public function reorder(Request $request)
    {
        $data=$request->menuItem_;
        $menu = new ZeusMenu();
        $menu->reorder_menu($data);
        return response()->json(['status'=>true]);
    }
}