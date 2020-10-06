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
use Zeus\App\Controllers\ZeusController;

class ModuleAccessController extends ZeusController
{
    public function index()
    {
        $group = new ZeusUserGroup();
        $user_group = $group->groups();
        return zeus_view('zeus::config.module_access.index', ['title' => 'Access Module Manager'], compact('user_group'));
    }

    public function get_access(Request $request)
    {
        if ($request->ajax()) {
            $data = [];
            $group_id = $request->id;
            if (!empty($group_id)) {
                $query_data = DB::table('zeus_module_sub')
                ->join('zeus_module', 'zeus_module_sub.zeus_module_id', 'zeus_module.id')
                ->select('zeus_module_sub.id', 'zeus_module_sub.name as sub_module', 'zeus_module.name as module', DB::Raw("(IF( EXISTS(SELECT * FROM zeus_module_access WHERE user_group_id =  " . $group_id . " AND zeus_module_sub_id=zeus_module_sub.id), 1, 0)) as active"))
                ->orderBy('id', 'desc')
                ->get();
                $collection = collect($query_data);
                $group = $collection->groupBy('module');
                $data = $group->toArray();
                // dd($data);
            }
            $view = view('zeus::config.module_access.data', compact('data', 'group_id'));
            echo $view->render();
        } else {
            die('Not ajax request');
        }
    }


    public function update(Request $request)
    {
        if ($request->ajax()) {
            ModuleAccess::where('user_group_id', $request->id)->delete();
            $count=ModuleAccess::count();
            if($count == 0)
            {
                ModuleAccess::truncate();
            }
            if (!empty($request->item)) {
                $insert_batch=[];
                foreach ($request->item as $k => $v) {
                    if (!empty($v)) {
                        $insert_batch[]=[
                            'user_group_id' => $request->id,
                            'zeus_module_sub_id' => $k
                        ];
                    }
                }
                ModuleAccess::insert($insert_batch);
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