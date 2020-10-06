<?php

namespace Zeus\App\Controllers;

use DB;
use Route;
use Zeus\App\Models\Module;
use Illuminate\Http\Request;
use Zeus\App\Models\ModuleSub;
use Zeus\Libraries\ZeusModule;
use Zeus\App\Models\ModuleAccess;
use Zeus\Libraries\ZeusUserGroup;
use Zeus\Libraries\ZeusMenu;
use Zeus\App\Controllers\ZeusController;

class MenuAccessController extends ZeusController
{
    public function index()
    {
        $group = new ZeusUserGroup();
        $user_group = $group->groups();
        return zeus_view('zeus::config.menu_access.index', ['title' => 'Access Menu Manager'], compact('user_group'));
    }

    public function get_access(Request $request)
    {
        if ($request->ajax()) {
            $menu = new ZeusMenu();
            $data = $menu->menu_access($request->id);
            $group_id= $request->id;
            $view = view('zeus::config.menu_access.data', compact('data', 'group_id'));
            
            echo $view->render();
        } else {
            die('Not ajax request');
        }
    }

    
    


    public function update(Request $request)
    {
        if ($request->ajax()) {
            DB::table('zeus_menu_access')->where('user_group_id', $request->id)->delete();
           
            if (!empty($request->item)) {
                $insert_batch = [];
                foreach ($request->item as $k => $v) {
                    if (!empty($v)) {
                        $insert_batch[] = [
                            'user_group_id' => $request->id,
                            'menu_id' => $k
                        ];
                    }
                }
                DB::table('zeus_menu_access')->insert($insert_batch);
            }
            return response()->json(array('status' => true));
        } else {
            die('Not ajax request');
        }
    }

    public function resetAutoincrement()
    {
        $max = ModuleAccess::max('id') + 1;
        DB::statement("ALTER TABLE zeus_module_access AUTO_INCREMENT =  $max");
    }
}
