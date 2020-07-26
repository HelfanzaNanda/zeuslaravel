<?php

namespace Zeus\Libraries;
use Zeus\Libraries\ZeusConfig;

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
        return $zeus->meta_global_delete('user_group', $name);
    }
}