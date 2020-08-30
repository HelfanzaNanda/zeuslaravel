<?php

route::get('/', 'LoginController@index');
route::get('/login', 'LoginController@index')->name('login');
route::post('/login/do', 'LoginController@signin')->name('login.do');
route::post('/login/send_verification', 'LoginController@send_verification')->name('login.send_verification');
route::get('/forgot/{token}', 'LoginController@forgot_verified')->name('login.forgot.verified');
route::get('/change_password', 'LoginController@change_password')->name('login.forgot.change_password');
route::post('/update_password', 'LoginController@update_password')->name('login.forgot.update_password');

Route::group(['middleware' => 'zeus.auth'], function () {
    Route::prefix('core')->group(function () {
        Route::prefix('account')->group(function () {
            route::get('dashboard', 'Account\DashboardController@index')->name('core.account.dashboard');
            Route::get('profile', 'Account\ProfileController@index')->name('core.account.profile');
            Route::post('profile/update', 'Account\ProfileController@profile_update')->name('core.account.profile.update');
            Route::post('avatar/update', 'Account\ProfileController@avatar_update')->name('core.account.avatar.update');
            Route::get('core/account/signout', 'Account\SignOutController@index')->name('core.account.signout');
        });
        Route::prefix('user')->group(function () {
            Route::prefix('group')->group(function () {
                route::get('/', 'User\GroupController@index')->name('core.user.group');
                route::post('/store', 'User\GroupController@store')->name('core.user.group.store');
                route::get('/delete/{id}', 'User\GroupController@delete')->name('core.user.group.delete');
                route::get('/access/{id}', 'User\GroupController@access')->name('core.user.group.access');
                route::get('/show_modules', 'User\GroupController@show_modules')->name('core.user.group.show_modules');
                route::post('/save_access', 'User\GroupController@save_access')->name('core.user.group.save_access');
            });
            Route::prefix('master')->group(function () {
                route::get('/', 'User\MasterController@index')->name('core.user.master');
                route::get('/add', 'User\MasterController@add')->name('core.user.master.add');
                route::get('/datatables', 'User\MasterController@datatables')->name('core.user.master.datatables');
                route::post('/store', 'User\MasterController@store')->name('core.user.master.store');
                route::post('/update', 'User\MasterController@update')->name('core.user.master.update');
                route::get('/detail/{id}', 'User\MasterController@detail')->name('core.user.master.detail');
                route::get('/delete/{id}', 'User\MasterController@delete')->name('core.user.master.delete');
            });
        });
        Route::prefix('config')->group(function () {
            route::get('application', 'ConfigController@application')->name('core.config.application');
            route::post('app/update', 'ConfigController@app_update')->name('core.config.app_update');
            route::post('logo/update', 'ConfigController@logo_update')->name('core.config.logo_update');
            route::get('company', 'ConfigController@company')->name('core.config.company');
            route::post('company/update', 'ConfigController@company_update')->name('core.config.company_update');
        });
        Route::prefix('tools')->group(function () {
            Route::prefix('send_email')->group(function () {
                route::get('/', 'Tools\SendEmailController@index')->name('core.tools.send_email');
                route::post('/send_email_do', 'Tools\SendEmailController@send_email_do')->name('core.tools.send_email.do');
            });
            Route::prefix('menu_builder')->group(function () {
                route::get('/', 'Tools\MenuBuilderController@index')->name('core.tools.menu_builder');
                route::post('/store', 'Tools\MenuBuilderController@store')->name('core.tools.menu_builder.store');
                route::get('/menu_get', 'Tools\MenuBuilderController@menu_get')->name('core.tools.menu_builder.menu_get');
                route::get('/menu_parent', 'Tools\MenuBuilderController@menu_parent')->name('core.tools.menu_builder.menu_parent');
                route::get('/confirm_delete', 'Tools\MenuBuilderController@confirm_delete')->name('core.tools.menu_builder.confirm_delete');
                route::post('/menu_delete', 'Tools\MenuBuilderController@menu_delete')->name('core.tools.menu_builder.menu_delete');
                route::get('/confirm_edit', 'Tools\MenuBuilderController@confirm_edit')->name('core.tools.menu_builder.confirm_edit');
                route::post('/menu_edit', 'Tools\MenuBuilderController@menu_edit')->name('core.tools.menu_builder.menu_edit');
                route::get('/reorder', 'Tools\MenuBuilderController@reorder')->name('core.tools.menu_builder.reorder');
            });
        });
    });
});
