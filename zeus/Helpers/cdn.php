<?php

if(!function_exists('cdn_datatables'))
{
    function cdn_datatables()
    {
        $local = asset('vendors') . '/';
        $html='';
        $html   .= add_css($local. 'dataTables1.10.22/datatables.min.css');
        $html   .= add_css($local . 'dataTables1.10.22/DataTables-1.10.22/css/dataTables.bootstrap4.min.css');
        $html   .= add_css($local . 'dataTables1.10.22/Responsive-2.2.6/css/responsive.bootstrap4.min.css');
        $html   .= add_js($local. 'dataTables1.10.22/datatables.min.js');
        $html   .= add_js($local . 'dataTables1.10.22/DataTables-1.10.22/js/dataTables.bootstrap4.min.js');
        $html   .= add_js($local . 'dataTables1.10.22/Responsive-2.2.6/js/responsive.bootstrap4.min.js');

        return $html;
    }
}

if(!function_exists('cdn_select2'))
{
    function cdn_select2()
    {
        $local = asset('vendors') . '/';
        $html = '';
        $html   .= add_css($local . 'select24.0.13/css/select2.min.css');
        $html   .= add_css($local . 'select24.0.13/css/select2-bootstrap4.min.css');
        $html   .= add_js($local . 'select24.0.13/js/select2.full.min.js');
        return $html;
    }
}

if (!function_exists('cdn_jqueryui')) 
{
    function cdn_jqueryui()
    {
        $local = asset('vendors') . '/';
        $html = '';
        $html   .= add_css($local . 'jquery-ui-1.12.1/jquery-ui.min.css');
        $html   .= add_js($local . 'jquery-ui-1.12.1/jquery-ui.min.js');
        return $html;
    }
}