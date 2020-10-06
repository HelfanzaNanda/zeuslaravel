<?php

namespace Zeus\App\Controllers;

use Zeus\App\Controllers\ZeusController;
use Zeus\Libraries\ZeusModule;
use Zeus\App\Models\Module;
use Zeus\App\Models\ModuleSub;
use Zeus\App\Models\ModuleAccess;
use Illuminate\Http\Request;

class ModuleController extends ZeusController
{

    public function index()
    {
        $data= Module::all();
        return zeus_view('zeus::config.module.index', ['title' => 'Module Manager'],compact('data'));
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name'    =>  'required'
        ]);
        
        if ($validator->fails()) {
            return back()->with('error','Validation Error');
        }
        $add=new Module();
        $add->name      = $request->name;
        $save=$add->save();
        if($save)
        {
            return redirect()->route('core.config.module.index')->with('succes','Successfully added module');
        }else{
            return back()->with('error', 'Failed add module');
        }
    }

    public function edit($id)
    {
        $data= Module::find($id);
        if(empty($data->id))
        {
            return back()->with('error', 'Data not found');
        }
        return zeus_view('zeus::config.module.edit', ['title' => 'Edit Module Manager'],compact('data'));
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
        $edit=Module::find($request->id);
        $edit->name     = $request->name;
        $save = $edit->save();
        if ($save)
        {
            return redirect()->route('core.config.module.index')->with('succes', 'Successfully updated module');
        }else{
            return back()->with('error', 'Failed update module');
        }
    }

    public function delete($id)
    {
        $action=Module::where('id',$id)->delete();
        if($action==true)
        {
            ModuleSub::where('zeus_module_id', $id)->delete();
            return redirect()->route('core.config.module.index')->with('succes', 'Successfully deleted module');
        } else {
            return back()->with('error', 'Failed delete module');
        }
    }
}