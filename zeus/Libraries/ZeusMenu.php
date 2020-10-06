<?php

namespace Zeus\Libraries;

use Zeus\App\Models\Menu;
use Zeus\Libraries\ZeusUserGroup;
use DB;
use Route;
use Illuminate\Http\Request;

class ZeusMenu
{
    protected $data_array = [];
    //Getting Data

    public function menu_detail($menu_id)
    {
        $data = Menu::find($menu_id);
        return $data;
    }

    public function menu_parent($keyword = '', $show_admin = false)
    {
        $query = Menu::whereNull('zeus_menu_id');
        if (!empty($keyword)) {
            $query->where('title', '%' . $keyword . '%');
        }
        if ($show_admin == false) {
            $query->where('is_admin', 0);
        }
        $data = $query->orderBy('precedence', 'asc')->get();
        return $data;
    }

    public function zeus_group_array()
    {
        $role_name = user_role_name();
        $query = Menu::orderBy('precedence', 'asc');
        $data_db = $query->get();
        // if ($role_name == 'superadmin') {
        //     $query = Menu::orderBy('precedence', 'asc');
        //     $data_db = $query->get();
        // } else {
        //     $role_id = user_role_id();
        //     $data_db = DB::table('zeus_menu_group')
        //         ->select('zeus_menu.*')
        //         ->join('zeus_menu', 'zeus_menu_group.zeus_menu_id', 'zeus_menu.id')
        //         ->where('zeus_menu_group.user_group_id', $role_id)
        //         ->whereNull('zeus_menu.deleted_at')
        //         ->orderBy('precedence', 'asc')
        //         ->get();
        // }

        $output = [];
        if (!empty($data_db)) {
            $arr = json_decode(json_encode($data_db), true);
            $output = $this->build_menu($arr, NULL, 0);
        }
        return $output;
    }

    public function menu_data($show_admin_menu = 0)
    {
        $query = Menu::orderBy('precedence', 'asc');
        if ($show_admin_menu == 0) {
            $query->where('is_admin', 0);
        }
        $data = $query->get();
        $output = [];
        if (!empty($data)) {
            $item = collect();
            foreach ($data as $row) {
                $item->push($row);
            }
            $data = $item->toArray();
            $output = $this->build_menu($data, NULL, 0);
        }
        return $output;
    }


    public function menu_access($user_group_id)
    {
        $output=[];
        $query = Menu::where('is_admin',0)->orderBy('precedence', 'asc');
        $data = $query->get();
        $list_menu_id=[];
        if(count($data))
        {
            foreach($data as $row)
            {
                $list_menu_id[]=$row->id;
            }

            $access=DB::table('zeus_menu_access')->where('user_group_id', $user_group_id)->whereIn('menu_id',$list_menu_id)->get();
            
            $check=[];
            foreach($access as $a)
            {
                $check[$a->menu_id]=true;
            }
            

            foreach($data as $row2)
            {
                $output[]=[
                    'id'=>$row2->id,
                    'title'=>$row2->title,
                    'active'=> isset($check[$row2->id]) ? 1 : 0
                ];
            }
        } 
        return $output;
    }

    private function get_access_menu($user_group_id)
    {
        $check = [];
        $query = Menu::where('is_admin', 0)->orderBy('precedence', 'asc');
        $data = $query->get();
        $list_menu_id = [];
        if (count($data)) {
            foreach ($data as $row) {
                $list_menu_id[] = $row->id;
            }

            $access = DB::table('zeus_menu_access')->where('user_group_id', $user_group_id)->whereIn('menu_id', $list_menu_id)->get();

            
            foreach ($access as $a) {
                $check[$a->menu_id] = true;
            }
        }
        return $check;
    }

    private function build_menu($data, $menu_parent = NULL)
    {
        $output = [];
        $role_name = user_role_name();
        $role_id=user_role_id();
        $data_access=$this->get_access_menu($role_id);
        $request_route = \Request::route()->getName();
        foreach ($data as $item) {
            $segment = json_decode($item['segment']);
            $route = 'core.account.dashboard';
            if (!empty($item['route_name'])) {
                if (Route::has($item['route_name'])) {
                    $route = $item['route_name'];
                }
            }

            $active = false;
            if ($request_route == $route) {
                $active = true;
            }


            if ($menu_parent == NULL && empty($item['zeus_menu_id'])) {
                $child = $this->build_menu($data, $item['id']);
                // dd($item['id']);
                if ($role_name == "superadmin") 
                {
                    $output[$item['title']] = [
                        'menu_id' => $item['id'],
                        'can_edit' => $item['can_edit'],
                        'can_delete' => $item['can_delete'],
                        'is_admin' => $item['is_admin'],
                        's1' => isset($segment[0]) ? $segment[0] : "",
                        's2' => isset($segment[1]) ? $segment[1] : "",
                        's3' => isset($segment[2]) ? $segment[2] : "",
                        'icon' => $item['icon'],
                        'zeus_menu_id' => $item['zeus_menu_id'],
                        'route' => $route,
                        'active' => $active,
                        'child' => $child
                    ];
                } elseif ($role_name != "superadmin" && $item['is_admin'] == 0) {
                    if (isset($data_access[$item['id']])) 
                    {
                        $output[$item['title']] = [
                            'menu_id' => $item['id'],
                            'can_edit' => $item['can_edit'],
                            'can_delete' => $item['can_delete'],
                            'is_admin' => $item['is_admin'],
                            's1' => isset($segment[0]) ? $segment[0] : "",
                            's2' => isset($segment[1]) ? $segment[1] : "",
                            's3' => isset($segment[2]) ? $segment[2] : "",
                            'icon' => $item['icon'],
                            'zeus_menu_id' => $item['zeus_menu_id'],
                            'route' => $route,
                            'active' => $active,
                            'child' => $child
                        ];
                    }
                }
            } else {
                if (!empty($item['zeus_menu_id']) && $item['zeus_menu_id'] == $menu_parent) {

                    if ($role_name == "superadmin") 
                    {
                        $output[$item['title']] = [
                            'menu_id' => $item['id'],
                            'can_edit' => $item['can_edit'],
                            'can_delete' => $item['can_delete'],
                            'is_admin' => $item['is_admin'],
                            's1' => isset($segment[0]) ? $segment[0] : "",
                            's2' => isset($segment[1]) ? $segment[1] : "",
                            's3' => isset($segment[2]) ? $segment[2] : "",
                            'icon' => $item['icon'],
                            'zeus_menu_id' => $item['zeus_menu_id'],
                            'route' => $route,
                            'active' => $active,
                        ];
                        
                    } elseif ($role_name != "superadmin" && $item['is_admin'] == 0) {
                        if (isset($data_access[$item['id']])) {
                            $output[$item['title']] = [
                                'menu_id' => $item['id'],
                                'can_edit' => $item['can_edit'],
                                'can_delete' => $item['can_delete'],
                                'is_admin' => $item['is_admin'],
                                's1' => isset($segment[0]) ? $segment[0] : "",
                                's2' => isset($segment[1]) ? $segment[1] : "",
                                's3' => isset($segment[2]) ? $segment[2] : "",
                                'icon' => $item['icon'],
                                'zeus_menu_id' => $item['zeus_menu_id'],
                                'route' => $route,
                                'active' => $active,
                            ];
                        }
                        
                    }
                }
            }
        }
        return $output;
    }

    public function access_menu($menu_id)
    {
        // $access_menu_db = DB::table('zeus_menu_group')
        //     ->select('user_group_id')->where('zeus_menu_id', $menu_id)->get();
        // $access_menu = [];
        // if (!empty($access_menu_db)) {
        //     foreach ($access_menu_db as $amb) {
        //         $access_menu[] = $amb->user_group_id;
        //     }
        // }
        // dd($access_menu);
        // $group_lib = new ZeusUserGroup();
        // $group = $group_lib->groups();
        // $output = [];
        // if (!empty($group)) {
        //     foreach ($group as $row) {
        //         if ($row->meta_key != 'superadmin') {
        //             $chk = 0;
        //             if (!empty($access_menu)) {
        //                 if (in_array($row->id, $access_menu)) {
        //                     $chk = 1;
        //                 }
        //             }
        //             $output[] = [
        //                 'id' => $row->id,
        //                 'meta_key' => $row->meta_key,
        //                 'meta_value' => $row->meta_value,
        //                 'chk' => $chk
        //             ];
        //         }
        //     }
        // }
        // return $output;
    }

    // CRUD
    public function create_menu($title, $segment = [], $icon, $route_name = '', $route_prefix = [], $menu_parent = NULL, $group_access = [])
    {
        $code = $this->create_menu_code($title);
        $check = Menu::where('menu_code', $code)->count();
        if ($check > 0) {
            return array(
                'status' => false,
                'message' => 'Menu ' . $title . ' has exists'
            );
        }

        $precedence = $this->precedence_menu($menu_parent);

        $add = new Menu();
        $add->menu_code = $code;
        $add->title = $title;
        $add->segment = json_encode($segment);
        $add->icon  = $icon;
        $add->zeus_menu_id  = $menu_parent;
        $add->route_name    = $route_name;
        $add->route_prefix_json = json_encode($route_prefix);
        $add->precedence = $precedence;
        $save = $add->save();
        if ($save) {
            return array(
                'status' => true,
                'message' => 'Successfully created menu ' . $title
            );
        } else {
            return array(
                'status' => false,
                'message' => 'Failed create menu ' . $title
            );
        }
    }

    public function edit_menu($menu_id, $title, $segment = [], $icon, $route_name, $route_prefix = [], $group_access = [])
    {
        $menu_info = Menu::find($menu_id);
        $last_menu_code = $menu_info->menu_code;
        $new_menu_code = $this->create_menu_code($title);

        $is_double = TRUE;
        if ($last_menu_code == $new_menu_code) {
            $is_double = FALSE;
        } else {
            $check = Menu::where('menu_code', $new_menu_code)->count();
            if ($check == 0) {
                $is_double = FALSE;
            }
        }

        if ($is_double == TRUE) {
            return array(
                'status' => false,
                'message' => 'Menu ' . $title . ' has exists'
            );
        }

        if ($menu_info->can_edit == 0) {
            return array(
                'status' => false,
                'message' => 'Menu cannot be update'
            );
        }

        $edit = Menu::find($menu_info->id);
        $edit->title = $title;
        $edit->segment = json_encode($segment);
        $edit->icon  = $icon;
        $edit->route_name    = $route_name;
        $edit->route_prefix_json = $route_prefix;
        $save = $edit->save();
        if ($save) {            
            return array(
                'status' => true,
                'message' => 'Successfully updated menu ' . $title
            );
        } else {
            return array(
                'status' => false,
                'message' => 'Failed update menu ' . $title
            );
        }
    }

    public function delete_menu($menu_id, $delete_child = FALSE)
    {
        $edit = Menu::find($menu_id);
        $title = $edit->title;
        if ($edit->can_delete == 0) {
            return array(
                'status' => false,
                'message' => 'Menu cannot be delete'
            );
        }

        $delete = $edit->delete();
        if ($delete) {
            if ($delete_child == TRUE) {
                Menu::where('zeus_menu_id', $menu_id)->delete();
            } else {
                Menu::where('zeus_menu_id', $menu_id)->update([
                    'zeus_menu_id' => NULL
                ]);
            }

            return array(
                'status' => true,
                'message' => 'Successfully delete menu ' . $title
            );
        } else {
            return array(
                'status' => false,
                'message' => 'Failed delete menu ' . $title
            );
        }
    }

    public function menu_has_child($menu_id)
    {
        $count_child = Menu::where('zeus_menu_id', $menu_id)->count();
        if ($count_child > 0) {
            return true;
        } else {
            return false;
        }
    }

    private function create_menu_code($key)
    {
        $lower = strtolower($key);
        $remove_space = str_replace(" ", "", $lower);
        $code = md5($remove_space);
        return $code;
    }

    private function precedence_menu($menu_parent = NULL)
    {
        $precedence = 0;
        $get_last_precedence = Menu::whereNull('zeus_menu_id')
            ->select('precedence')
            ->orderBy('precedence', 'desc')->first();
        if (!empty($menu_parent)) {
            $get_last_precedence = Menu::where('zeus_menu_id', $menu_parent)
                ->select('precedence')
                ->orderBy('precedence', 'desc')->first();
        }

        if (isset($get_last_precedence->precedence)) {
            $precedence = $get_last_precedence->precedence + 1;
        }

        return $precedence;
    }

    public function reorder_menu($data)
    {
        $i = 0;
        $i2 = 0;
        if (!empty($data)) {
            foreach ($data as $k => $v) {

                if ($v == "null") {
                    $i += 1;
                    Menu::where('id', $k)->update([
                        'precedence' => $i,
                        'zeus_menu_id' => NULL
                    ]);
                } else {
                    $i2 += 1;
                    Menu::where('id', $k)->update([
                        'precedence' => $i2,
                        'zeus_menu_id' => $v
                    ]);
                }
            }
        }
        return true;
    }
}
