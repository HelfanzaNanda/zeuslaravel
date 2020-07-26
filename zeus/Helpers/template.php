<?php

if(!function_exists('menu_active'))
{
    function menu_active($slugOne, $slugTwo = "", $slugThree = "")
    {
        $s1 = Request::segment(1);
        $s2 = Request::segment(2);

        if (!empty($slugOne) && empty($slugTwo)) {
            if ($slugOne == $s1) {
                return true;
            }
        } elseif (!empty($slugOne) && !empty($slugTwo)) {
            if ($slugOne == $s1 && $slugTwo == $s2) {
                return true;
            } else {
                return false;
            }
        }
    }
}

if (!function_exists('add_js')) {
    function add_js($linkJS, $paramArray = array())
    {
        $param = string_implode_array($paramArray);
        return '<script src="' . $linkJS . '" ' . $param . '></script>'.PHP_EOL;
    }
}

if (!function_exists('add_css')) {
    function add_css($linkCSS, $paramArray = array())
    {
        $param = string_implode_array($paramArray);
        return '<link rel="stylesheet" href="' . $linkCSS . '" ' . $param . '/>' . PHP_EOL;
    }
}

