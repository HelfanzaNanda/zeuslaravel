<?php
use Carbon\Carbon;

if(!function_exists('date_now'))
{
    function date_now($show_time=false,$custom_time_zone="")
    {
        $app_timezone = env('APP_TIMEZONE', 'UTC');
        $local_timezone = env('LOCAL_TIMEZONE', 'Asia/Jakarta');
        $date=date("Y-m-d H:i:s");
        $date_convert = Carbon::parse($date, $app_timezone)->setTimeZone($local_timezone);
        if(!empty($custom_time_zone))
        {
            $date_convert = Carbon::parse($date, $app_timezone)->setTimeZone($custom_time_zone);
        }
        $date_final=$date_convert->format('Y-m-d');
        if($show_time==true)
        {
            $date_final= $date_convert->format('Y-m-d H:i:s');
        }

        return $date_final;
    }
}

if(!function_exists('date_utc'))
{
    function date_utc($show_time=false)
    {
        $date_convert=Carbon::now(new DateTimeZone("UTC"));
        $date_final = $date_convert->format('Y-m-d');
        if ($show_time == true) {
            $date_final = $date_convert->format('Y-m-d H:i:s');
        }

        return $date_final;
    }
}

if(!function_exists('date_convert_timezone'))
{
    function date_convert_timezone($date,$from_timezone,$to_timezone,$show_time=false)
    {
        $date_convert = Carbon::parse($date, $from_timezone)->setTimeZone($to_timezone);
        $date_final = $date_convert->format('Y-m-d');
        if ($show_time == true) {
            $date_final = $date_convert->format('Y-m-d H:i:s');
        }

        return $date_final;
    }
}

if(!function_exists('date_add_second'))
{
    function date_add_second($date,$second=1)
    {
        $date_convert=Carbon::parse($date)->addSeconds($second)->format("Y-m-d H:i:s");
        if($second == 0)
        {
            $date_convert=$date;
        }elseif($second < 0)
        {
            $date_convert = Carbon::parse($date)->subSeconds(abs($second))->format("Y-m-d H:i:s");
        }

        return $date_convert;
    }
}

if (!function_exists('date_add_minute')) {
    function date_add_minute($date, $minute = 1)
    {
        $date_convert = Carbon::parse($date)->addMinutes($minute)->format("Y-m-d H:i:s");
        if ($minute == 0) {
            $date_convert = $date;
        } elseif ($minute < 0) {
            $date_convert = Carbon::parse($date)->subMinutes(abs($minute))->format("Y-m-d H:i:s");
        }

        return $date_convert;
    }
}

if (!function_exists('date_add_hour')) {
    function date_add_hour($date, $hour = 1)
    {
        $date_convert = Carbon::parse($date)->addHours($hour)->format("Y-m-d H:i:s");
        if ($hour == 0) {
            $date_convert = $date;
        } elseif ($hour < 0) {
            $date_convert = Carbon::parse($date)->subHours(abs($hour))->format("Y-m-d H:i:s");
        }

        return $date_convert;
    }
}

if (!function_exists('date_add_day')) {
    function date_add_day($date, $day = 1)
    {
        $date_convert = Carbon::parse($date)->addDays($day)->format("Y-m-d H:i:s");
        if ($day == 0) {
            $date_convert = $date;
        } elseif ($day < 0) {
            $date_convert = Carbon::parse($date)->subDays(abs($day))->format("Y-m-d H:i:s");
        }

        return $date_convert;
    }
}

if (!function_exists('date_add_week')) {
    function date_add_week($date, $week = 1)
    {
        $date_convert = Carbon::parse($date)->addWeeks($week)->format("Y-m-d H:i:s");
        if ($week == 0) {
            $date_convert = $date;
        } elseif ($week < 0) {
            $date_convert = Carbon::parse($date)->subWeeks(abs($week))->format("Y-m-d H:i:s");
        }

        return $date_convert;
    }
}

if (!function_exists('date_add_year')) {
    function date_add_year($date, $year = 1)
    {
        $date_convert = Carbon::parse($date)->addYears($year)->format("Y-m-d H:i:s");
        if ($year == 0) {
            $date_convert = $date;
        } elseif ($year < 0) {
            $date_convert = Carbon::parse($date)->subYears(abs($year))->format("Y-m-d H:i:s");
        }

        return $date_convert;
    }
}

if (!function_exists('date_calculate_age')) {
    function date_calculate_age($date_of_birth)
    {
        $years = Carbon::parse($date_of_birth)->age;

        return $years;
    }
}

if (!function_exists('date_calculate_diff')) {
    function date_calculate_diff($date)
    {
        $diff = Carbon::parse($date)->diff(\Carbon\Carbon::now());
        return array(
            'year'=> $diff->format("%y"),
            'month'=> $diff->format("%m"),
            'day' => $diff->format("%d"),
            'hour' => $diff->format("%H"),
            'minute' => $diff->format("%i"),
            'second' => $diff->format("%s"),
        );
    }
}