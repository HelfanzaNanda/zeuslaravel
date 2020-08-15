<?php
use Zeus\Libraries\ZeusConfig;
use Zeus\Libraries\ZeusUser;

if(!function_exists('meta_read'))
{
    function meta_read($key)
    {
        $meta=new ZeusConfig();
        return $meta->meta_global_read('system',$key);
    }
}

if (!function_exists('config_read')) 
{
    function config_read($key)
    {
        $meta = new ZeusConfig();
        return $meta->config_read('general', $key);
    }
}

if (!function_exists('zeus_logo')) {
    function zeus_logo()
    {
        $meta = new ZeusConfig();
        return $meta->logo();
    }
}

if (!function_exists('zeus_favicon')) {
    function zeus_favicon()
    {
        $meta = new ZeusConfig();
        return $meta->favicon();
    }
}

if (!function_exists('user_info')) 
{
    function user_info($key="id")
    {
        $user = new ZeusUser();
        $user_data=$user->user_info_by_session();
        if(!empty($user_data->$key))
        {
            return $user_data->$key;
        }
    }
}

if (!function_exists('user_avatar')) 
{
    function user_avatar($size=200)
    {
        $user = new ZeusUser();
        $user_id=user_info('id');
        return $user->user_avatar($user_id,$size);
    }
}

if (!function_exists('user_role_id')) 
{
    function user_role_id()
    {
        $user = new ZeusUser();
        return $user->user_role_info()['group_id'];
    }
}

if (!function_exists('user_role_name')) 
{
    function user_role_name()
    {
        $user = new ZeusUser();
        return $user->user_role_info()['group_name'];
    }
}

if (!function_exists('user_role_value')) 
{
    function user_role_value()
    {
        $user = new ZeusUser();
        return $user->user_role_info()['group_value'];
    }
}

if (!function_exists('zeus_view')) {
    function zeus_view($view = '', $header_config = [], $data = [], $merge_data = [])
    {
        $header = array('title' => meta_read('app_name'));
        if (!empty($header_config)) {
            $header = $header_config;
        }
        $content = 'zeus::layout.nocontent';
        if (!empty($view)) {
            $content = $view;
        }
        $merge_core = array_merge(['content' => $content], $data, ['header' => $header]);
        return view('zeus::layout.master', $merge_core, $merge_data);
    }
}

if (!function_exists('app_copyright')) {
    function app_copyright()
    {
        $year_now=date("Y");
        $company_name= meta_read('company_name');
        $company_url = meta_read('company_web');
        $company_year = meta_read('app_year');

        $string= "Copyright &copy;";
        if($company_year == $year_now)
        {
            $string.=" ".$company_year;
        }else{
            $string.=" ".$company_year."-".$year_now;
        }
        
        if(!empty($company_url))
        {
            $string.=' <a href="'.$company_url.'" target="_blank">'.$company_name.'</a> ';
        }else{
            $string.=" ".$company_name;
        }

        return $string;
    }
}