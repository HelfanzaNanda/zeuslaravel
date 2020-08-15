<?php

namespace Zeus\App\Controllers;

use Zeus\App\Controllers\ZeusController;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Zeus\Libraries\ZeusSecurity;
use Zeus\Libraries\ZeusUser;
use Zeus\Libraries\ZeusUserGroup;
use Zeus\App\Models\User;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use Zeus\Libraries\ZeusConfig;
use Intervention\Image\ImageManager;

class ConfigController extends ZeusController
{

    public function application()
    {
        return zeus_view('zeus::config.application', ['title' => 'Application Configuration']);
    }

    public function app_update(Request $request)
    {
        $config=new ZeusConfig();
        $item = $request->input('item');
        foreach ($item as $k => $v) {
            $config->meta_global_update('system',$k,$v);
        }
        return redirect()->route('core.config.application')->with('success','Configuration Updated');
    }

    public function company()
    {
        return zeus_view('zeus::config.company', ['title' => 'Company Configuration']);
    }

    public function company_update(Request $request)
    {
        $config = new ZeusConfig();
        $item = $request->input('item');
        foreach ($item as $k => $v) {
            $config->meta_global_update('system', $k, $v);
        }
        return redirect()->route('core.config.company')->with('success', 'Configuration Updated');
    }

    public function logo_update(Request $request)
    {
        $upload=$this->app_change_logo($request->type);
        if($upload['status']==true)
        {
            return redirect()->route('core.config.application')->with('success', ucfirst($request->type).' Updated');
        }else{
            return redirect()->route('core.config.application')->with('danger', ucfirst($request->type) . ' Failed');
        }
    }

    private function app_change_logo($field_custom = 'logo')
    {
        $config=new ZeusConfig();
        $output = array();
        if (isset($_FILES[$field_custom]['name'])) {
            $extension = pathinfo($_FILES[$field_custom]['name'], PATHINFO_EXTENSION);
            $default_thumbnail = [200, 800];
            $thumbnail_size = $config->config_read('global', 'thumbnail_size');
            if (empty($thumbnail_size)) {
                $thumbnail_size = $default_thumbnail;
            }
            $path = $config->config_read('general', 'upload_path') . '/app/';
            $url = $config->config_read('general', 'upload_url') . '/app/';
            $avatar_name = $field_custom . "." . $extension;
            $avatar_file = $path . $avatar_name;
            $avatar_url = $url . '/' . $avatar_name;
            $manager = new ImageManager();
            $save = $manager->make($_FILES[$field_custom]['tmp_name'])->save($avatar_file);
            if ($save) {
                $this->create_directory($path . 'thumbs');
                foreach ($thumbnail_size as $k) {
                    $thumb_folder = $path . 'thumbs/' . $k;
                    $this->create_directory($thumb_folder);
                    $thumb_file = $thumb_folder . '/' . $avatar_name;
                    $manager->make($avatar_file)->resize($k)->save($thumb_file);
                }
                //Options::where('option_key', $field_custom)->update(['option_value' => $avatar_name]);
                $config->meta_global_update('system', $field_custom, $avatar_name);
                $output = array('status' => true, 'message' => 'Success Upload', 'img' => $avatar_url . '?time=' . time());
            } else {
                $output = array('status' => false, 'message' => 'Failed Upload');
            }
        } else {
            $output = array('status' => false, 'message' => 'Invalid Image');
        }
        return $output;
    }

    private function create_directory($path, $rewrite = TRUE)
    {
        if ($rewrite == TRUE) {
            return is_dir($path) || mkdir($path, 0755);
        } else {
            return is_dir($path) || mkdir($path, 0644);
        }
    }

    private function remove_directory($dir, $subfolder = FALSE)
    {
        if ($subfolder == TRUE) {
            $this->deleteAll($dir, TRUE);
            return rmdir($dir);
        } else {
            return rmdir($dir);
        }
    }

}