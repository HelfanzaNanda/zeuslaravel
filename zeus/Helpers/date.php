<?php

if (!function_exists('date_now')) {    
    function date_now($time = FALSE,$with_timezone=FALSE,$custom_time_zone="")
    {
        if($with_timezone == TRUE)
        {
            if(!empty($custom_time_zone))
            {
                date_default_timezone_set($custom_time_zone);
            }else{
                $timezone = env('LOCAL_TIMEZONE', 'Asia/Jakarta');
                date_default_timezone_set($timezone);
            }         
        }        
        $str_format = '';
        if ($time == FALSE) {
            $str_format = date("Y-m-d");
        } else {
            $str_format = date("Y-m-d H:i:s");
        }
        return $str_format;
    }
}
