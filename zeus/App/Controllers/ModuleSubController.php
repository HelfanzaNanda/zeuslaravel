<?php

namespace Zeus\App\Controllers;

use Zeus\App\Controllers\ZeusController;
use Zeus\Libraries\ZeusModule;
use Zeus\App\Models\Module;
use Zeus\App\Models\ModuleSub;
use Zeus\App\Models\ModuleAccess;
use Illuminate\Http\Request;
use DB;
use Route;
use Yajra\Datatables\Datatables;

class ModuleSubController extends ZeusController
{
    private $protect_route = array('login', 'core', '_ignition', '', 'api', '_debugbar');
    public function index()
    {
        $data_module = Module::all();
        $route_list=$this->get_route();
        return zeus_view('zeus::config.module_sub.index', ['title' => 'Sub Module Manager'], compact('data_module', 'route_list'));
    }

    public function datatables(Datatables $datatables,Request $request)
    {
        $query=ModuleSub::select('zeus_module_sub.*', 'zeus_module.name as module_name')
            ->join('zeus_module', 'zeus_module_sub.zeus_module_id', 'zeus_module.id');

        if(!empty($request->module))
        {
            $query->where('zeus_module_sub.zeus_module_id',$request->module);
        }
        
        return $datatables->eloquent($query)
        ->addColumn('action', function($u){
            return '<a href="'.route('core.config.module_sub.edit',array('id'=>$u->id)).'" class="btn btn-info btn-xs"><i class="fa fa-edit"></i></a> 
            <a onclick="return confirm(\'Are you sure delete data '.$u->name.'?\');" href="'.route('core.config.module_sub.delete',array('id'=>$u->id)).'" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i></a> 
            ';
        })
        ->toJson();
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'module_id'    =>  'required',
            'name'    =>  'required',
            'route'    =>  'required',
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'Validation Error');
        }
        $add = new ModuleSub();
        $add->zeus_module_id        = $request->module_id;
        $add->name                  = $request->name;
        $add->route_name            = $request->route;
        $save = $add->save();
        if ($save) {
            return redirect()->route('core.config.module_sub.index')->with('succes', 'Successfully added sub module');
        } else {
            return back()->with('error', 'Failed add sub module');
        }
    }

    public function edit($id)
    {
        $data_module = Module::all();
        $data = ModuleSub::select('zeus_module_sub.*', 'zeus_module.name as module_name')
        ->join('zeus_module', 'zeus_module_sub.zeus_module_id', 'zeus_module.id')
        ->where('zeus_module_sub.id',$id)
        ->first();
        if (empty($data->id)) {
            return back()->with('error', 'Data not found');
        }
        $route_list = $this->get_route();
        return zeus_view('zeus::config.module_sub.edit', ['title' => 'Edit Sub Module Manager'], compact('data', 'data_module', 'route_list'));
    }

    public function update(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'id'    =>  'required',
            'name'    =>  'required',
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'Validation Error');
        }
        $edit = ModuleSub::find($request->id);
        $edit->zeus_module_id           = $request->module_id;
        $edit->name                     = $request->name;
        $edit->route_name               = $request->route;
        $save = $edit->save();
        if ($save) {
            return redirect()->route('core.config.module_sub.index')->with('succes', 'Successfully updated sub module');
        } else {
            return back()->with('error', 'Failed update sub module');
        }
    }

    public function delete($id)
    {
        $action = ModuleSub::where('id', $id)->delete();
        if ($action == true) {
            return redirect()->route('core.config.module_sub.index')->with('succes', 'Successfully deleted sub module');
        } else {
            return back()->with('error', 'Failed delete sub module');
        }
    }

    private function get_route()
    {
        $route_list=[];
        $routeCollection = Route::getRoutes();
        foreach ($routeCollection as $route) {
            $uri = $route->uri();
            $middleware = $route->action['middleware'];

            // if(isset($middleware[1]))
            $explode = explode("/", $uri);
            if (!in_array($explode[0], $this->protect_route)) {
                if (isset($middleware[1])) {
                    if ($middleware[1] == 'zeus.auth') {
                        $route_name = $route->action['as'];
                        $route_prefix = $route->action['prefix'];
                        $route_action = $route->action['controller'];
                        $explode_function = explode("@", $route_action);

                        $module_label = ucwords($uri);
                        if (!empty($route_prefix)) {
                            $module_label = str_replace("/", " ", $route_prefix);
                            $module_label = ucwords($module_label);
                        }
                        $access = 0;
                        if (isset($route_name_access[$route_name])) {
                            if ($route_name_access[$route_name] == 'on') {
                                $access = 1;
                            }
                        }
                        $route_list[]=$route_name;
                    }
                }
            }
        }

        return $route_list;
    }
}
