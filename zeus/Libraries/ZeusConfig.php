<?php

namespace Zeus\Libraries;

use Zeus\App\Models\Meta;

class ZeusConfig
{
    /**
     * Config Database
     */
    public function meta_global_group_fetch(String $group)
    {
        $output = '';
        $data = Meta::whereRaw("LOWER(meta_group) = ?", [strtolower($group)])
            ->whereNull('user_id')->get();
        return $data;
    }

    public function meta_global_find_by_id(String $meta_id)
    {
        $value = Meta::find($meta_id);
        return $value;
    }

    public function meta_global_read_by_id(String $meta_id)
    {
        $output = Meta::where('id',$meta_id)
            ->whereNull('user_id')->first();
        return $output;
    }

    public function meta_user_read_by_id(Int $user_id, String $meta_id)
    {
        $output = '';
        $value = Meta::where('id', $meta_id)
            ->where('user_id', $user_id)
            ->select('meta_value')->first();
        if (!empty($value)) {
            $output = $value->meta_value;
        }

        return $output;
    }

    public function meta_global_read(String $group,String $key)
    {
        $output = '';
        $value = Meta::whereRaw("LOWER(meta_key) = ?", [strtolower($key)])
            ->whereRaw("LOWER(meta_group) = ?", [strtolower($group)])
            ->whereNull('user_id')
            ->select('meta_value')->first();
        if (!empty($value)) {
            $output = $value->meta_value;
        }

        return $output;
    }

    public function meta_user_read(Int $user_id, String $group,String $key)
    {
        $output = '';
        $value = Meta::whereRaw("LOWER(meta_key) = ?", [strtolower($key)])
            ->whereRaw("LOWER(meta_group) = ?", [strtolower($group)])
            ->where('user_id',$user_id)
            ->select('meta_value')->first();
        if (!empty($value)) {
            $output = $value->meta_value;
        }

        return $output;
    }

    public function meta_global_update(String $group,String $key,String $value)
    {
        $update=Meta::whereRaw("LOWER(meta_key) = ?", [strtolower($key)])
        ->whereRaw("LOWER(meta_group) = ?", [strtolower($group)])
        ->whereNull('user_id')
        ->update([
            'meta_value'=>$value
        ]);
        if($update >= 0)
        {
            return true;
        }else{
            return false;
        }
    }

    public function logo()
    {
        $config = new ZeusConfig();
        $path = $config->config_read('general', 'upload_path') . '/app/';
        $url = $config->config_read('general', 'upload_url') . '/app/';
        $default = $config->config_read('general', 'logo');
        $image = $this->meta_global_read('system','logo');
        $file_path = $path . $image;
        $file_url = $url . $image;
        if (file_exists($file_path) && is_file($file_path)) {
            $default = $file_url;
        }

        return $default;
    }

    public function favicon()
    {
        $config = new ZeusConfig();
        $path = $config->config_read('general', 'upload_path') . '/app/';
        $url = $config->config_read('general', 'upload_url') . '/app/';
        $default = $config->config_read('general', 'logo');
        $image = $this->meta_global_read('system', 'favicon');
        $file_path = $path . $image;
        $file_url = $url . $image;
        if (file_exists($file_path) && is_file($file_path)) {
            $default = $file_url;
        }

        return $default;
    }

    public function meta_user_update(Int $user_id, String $group,String $key, String $value)
    {
        $update = Meta::whereRaw("LOWER(meta_key) = ?", [strtolower($key)])
            ->whereRaw("LOWER(meta_group) = ?", [strtolower($group)])
            ->where('user_id',$user_id)
            ->update([
                'meta_value' => $value
            ]);
        if ($update >= 0) 
        {
            return true;
        } else {
            return false;
        }
    }

    public function meta_global_delete(String $group,String $key)
    {
        $delete = Meta::whereRaw("LOWER(meta_key) = ?", [strtolower($key)])
            ->whereRaw("LOWER(meta_group) = ?", [strtolower($group)])
            ->where('editable',1)
            ->forceDelete();
        if ($delete) {
            return true;
        } else {
            return false;
        }
    }

    public function meta_user_delete(Int $user_id, String $group,String $key)
    {
        $delete = Meta::whereRaw("LOWER(meta_key) = ?", [strtolower($key)])
            ->whereRaw("LOWER(meta_group) = ?", [strtolower($group)])
            ->where('user_id',$user_id)
            ->forceDelete();
        if ($delete) 
        {
            return true;
        } else {
            return false;
        }
    }

    public function meta_global_add(String $group,String $key,String $value)
    {
        $check=Meta::whereRaw("LOWER(meta_group) = ?", [strtolower($group)])
            ->whereRaw("LOWER(meta_key) = ?", [strtolower($key)])
            ->count();
        if($check == 0)
        {
            $add=new Meta();
            $add->meta_group    = strtolower($group);
            $add->meta_key    = strtolower($key);
            $add->meta_value    = $value;
            $add->editable    = 1;
            $save=$add->save();
            if($save)
            {
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function meta_user_add(Int $user_id,String $group, String $key, String $value)
    {
        $check = Meta::whereRaw("LOWER(meta_group) = ?", [strtolower($group)])
            ->whereRaw("LOWER(meta_key) = ?", [strtolower($key)])
            ->where('user_id',$user_id)
            ->count();
        if ($check == 0) {
            $add = new Meta();
            $add->meta_group    = strtolower($group);
            $add->meta_key    = strtolower($key);
            $add->meta_value    = $value;
            $add->user_id    = $user_id;
            $add->editable    = 1;
            $save = $add->save();
            if ($save) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /** 
     * Config File
     */

    public function config_read($file,$key)
    {
        $path = base_path('zeus/Config/' . $file . '.php');
        if (file_exists($path) && is_file($path)) 
        {
            include($path);            
            return $config[$key];
        } else {
            return "";
        }
    }


    public function version()
    {
        return $this->meta_read('app_version');
    }
}
