<?php

namespace Zeus\Libraries;
use Zeus\Libraries\ZeusConfig;
use Zeus\App\Models\Meta;

class ZeusUserGroup
{
    public function groups()
    {
        $zeus=new ZeusConfig();
        return $zeus->meta_global_group_fetch('user_group');
    }

    public function group_info($group_id)
    {
        $zeus = new ZeusConfig();
        return $zeus->meta_global_read_by_id($group_id);
    }

    public function group_add($key,$name)
    {
        $zeus = new ZeusConfig();
        return $zeus->meta_global_add('user_group',$name, $key);
    }

    public function group_edit($name,$value)
    {
        $zeus = new ZeusConfig();
        return $zeus->meta_global_update('user_group', $name, $value);
    }

    public function group_delete($name)
    {
        $zeus = new ZeusConfig();
        $action=$zeus->meta_global_delete('user_group', $name);
        if($action)
        {
            Meta::where('meta_group', 'user_group_access')->where('meta_key', $name)->forceDelete();
            return true;
        }else{
            return false;
        }
    }

    public function zeus_user_group_access($user_group_name)
    {
        $data=Meta::where('meta_group','user_group_access')->where('meta_key',$user_group_name)
        ->first();
        $output=array();
        if(!empty($data->meta_value))
        {
            $output=json_decode($data->meta_value,true);
        }
        return $output;
    }

    public function zeus_user_group_access_update($user_group_name,$data)
    {
        $data_save="";
        if(!empty($data))
        {
            $data_save=json_encode($data);
        }
        $update=Meta::updateOrCreate([
            'meta_group'=> 'user_group_access',
            'meta_key'=> $user_group_name
        ],[
            'meta_value'=> $data_save
        ]);
        if($update)
        {
            return true;
        }else{
            return false;
        }
    }
}