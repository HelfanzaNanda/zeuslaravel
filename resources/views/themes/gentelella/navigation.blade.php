<?php
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
        if (isset($v['child']) && !empty($v['child'])) {
            if (menu_active($Slug_1, $Slug_2, $Slug_3) == TRUE) {
                $aktif = "active";
                $aktif2 = "menu-open";
            }
            $output .= '
			<li class="' . $aktif2 . '">
				<a href="javascript:;">
                    <i class="' . $icon . '"></i>
                     ' . $k . '
                    <span class="fa fa-chevron-down"></span>
				</a>
			';
            $output .= '<ul class="nav child_menu">';
            $output .= template_menu($v['child']);
            $output .= '</ul>';
            $output .= '</li>';
        } else {
            if (menu_active($Slug_1, $Slug_2, $Slug_3) == TRUE) {
                $aktif = "active";
            }
            if(isset($v['zeus_menu_id']) && !empty($v['zeus_menu_id']))
            {
                $output .= '
                <li class="'. $aktif.'">
                    <a href="' . $route_generate . '" target="' . $target . '">
                        ' . $k . '
                    </a>
                </li>
                ';
            }else{
                $output .= '
                <li class="' . $aktif . '">
                    <a href="' . $route_generate . '" target="' . $target . '">
                        <i class="' . $icon . '"></i>
                        ' . $k . '
                    </a>
                </li>
                ';
            }
           
           
        }
    }
    return $output;
}

$navData = zeus_menu();
echo template_menu($navData);
