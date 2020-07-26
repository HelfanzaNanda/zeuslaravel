<?php
$path = base_path('app/Navigation/'.user_role_name().'.php');
$navFile = array();
if (file_exists($path)) {
    $navFile = include($path);
}
function template_menu($menu)
{
    $output = '';
    $i_order=0;
    foreach ($menu as $k => $v) {
        $i_order+=1;

        $Slug_1 = isset($v['s1']) ? $v['s1'] : "";
        $Slug_2 = isset($v['s2']) ? $v['s2'] : "";
        $Slug_3 = isset($v['s3']) ? $v['s3'] : "";
        $route = isset($v['route']) ? $v['route'] : "";
        $params = isset($v['params']) ? $v['params'] : "";
        $target = isset($v['target']) ? $v['target'] : "";
        $icon = isset($v['icon']) ? $v['icon'] : "fa fa-circle-o";
        $active = '';
        $route_generate = '';
        if (!empty($route)) {
            if (!empty($params)) {
                $route_generate = route($route, $params);
            } else {
                $route_generate = route($route);
            }
        }
        if (isset($v['child'])) {
            if (menu_active($Slug_1, $Slug_2, $Slug_3) == TRUE) {
                $active = "active";
            }
            $output .= '<li class="nav-item '.$active.'">';
            $output .= '<a class="nav-link" data-toggle="collapse" href="#item_menu_'. $i_order. '" aria-expanded="false" aria-controls="item_menu_' . $i_order . '"> ';
            $output .= '<span class="menu-title">' . $k . '</span>';
            $output .= '<i class="menu-arrow"></i> ';
            $output .= '<i class="' . $icon . ' menu-icon"></i>';
            $output .= '</a> ';
            $output .= '<div class="collapse" id="item_menu_' . $i_order . '">';
            $output .= '<ul class="nav flex-column sub-menu"> ';
            $output .= template_menu($v['child']);
            $output .= '</ul>';
            $output .= '</div> ';
            $output .= '</li>';

        } else {
            if (menu_active($Slug_1, $Slug_2, $Slug_3) == TRUE) {
                $active = "active";
            }
            $output .= '<li class="nav-item '.$active.'">';
            $output .= '<a class="nav-link" href="' . $route_generate . '">';
            $output .= '<span class="menu-title">' . $k . '</span>';
            $output .='<i class="'.$icon.' menu-icon"></i>';
            $output .='</a>';
            $output .='</li>';
        }
    }
    return $output;
}

echo template_menu($navFile);
