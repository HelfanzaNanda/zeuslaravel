<?php

$menu_admin = [
    'Manage User' => [
        's1' => 'core',
        's2' => 'user',
        'icon' => 'far fa-user',
        'child' => [
            'User Groups' => [
                'icon' => 'far fa-circle',
                'route' => 'core.user.group'
            ],
            'Users' => [
                'icon' => 'far fa-circle',
                'route' => 'core.user.master'
            ]
        ]
    ]
];

$menu_config = [
    'Configuration' => [
        's1' => 'core',
        's2' => 'config',
        'icon' => 'fa fa-wrench',
        'child' => [
            'Application' => [
                'icon' => 'far fa-circle',
                'route' => 'core.config.application'
            ],
            'Company' => [
                'icon' => 'far fa-circle',
                'route' => 'core.config.company'
            ]
        ]
    ]
];


return array_merge($menu_admin, $menu_config);

/*
Jika menu sama dengan role akses lainnya, pada role navigation file tambahkan
$menu = include('superadmin.php');
return $menu;
*/