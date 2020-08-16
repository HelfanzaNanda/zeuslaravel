<?php
$path = base_path('zeus_config/Navigation/' . user_role_name() . '.php');
$navFile = array();
if (file_exists($path)) {
    $navFile = include($path);
}
function template_menu($menu)
{
    $output = '';

    foreach ($menu as $k => $v) {

        $Slug_1 = isset($v['s1']) ? $v['s1'] : "";
        $Slug_2 = isset($v['s2']) ? $v['s2'] : "";
        $Slug_3 = isset($v['s3']) ? $v['s3'] : "";
        $route = isset($v['route']) ? $v['route'] : "";
        $params = isset($v['params']) ? $v['params'] : "";
        $target = isset($v['target']) ? $v['target'] : "";
        $icon = isset($v['icon']) ? $v['icon'] : "far fa-circle-o";
        $aktif = '';
        $aktif2 = '';
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
                $aktif = "active";
                $aktif2 = "menu-open";
            }
            $output .= '
			<li class="nav-item has-treeview '.$aktif2.'">
				<a href="javascript:;" class="nav-link '. $aktif.'">
                    <i class="nav-icon ' . $icon . '"></i>
                    <p>
                        '.$k. '
                        <i class="fas fa-angle-left right"></i>
                    </p>
				</a>
			';
            $output .= '<ul class="nav nav-treeview">';
            $output .= template_menu($v['child']);
            $output .= '</ul>';
            $output .= '</li>';
        } else {
            if (menu_active($Slug_1, $Slug_2, $Slug_3) == TRUE) {
                $aktif = "active";
            }
            $output .= '
			<li class="nav-item">
				<a href="' . $route_generate . '" target="' . $target . '" class="nav-link '. $aktif. '">
                    <i class="nav-icon ' . $icon . '"></i> 
                    <p>
                    ' . $k . '
                    </p>
				</a>
			</li>
			';
        }
    }
    return $output;
}

echo template_menu($navFile);
