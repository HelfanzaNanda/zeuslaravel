<?php

route::get('/', 'LoginController@index');
route::get('/login', 'LoginController@index')->name('login');
route::post('/login/do', 'LoginController@signin')->name('login.do');

Route::group(['middleware' => 'zeus.auth'], function () {
    Route::prefix('core')->group(function () {
        Route::prefix('account')->group(function () {
            route::get('dashboard', 'Account\DashboardController@index')->name('core.account.dashboard');
            Route::get('profile', 'Account\ProfileController@index')->name('core.account.profile');
            Route::post('profile/update', 'Account\ProfileController@profile_update')->name('core.account.profile.update');
            Route::post('avatar/update', 'Account\ProfileController@avatar_update')->name('core.account.avatar.update');
            Route::get('signout', 'Account\SignOutController@index')->name('core.account.signout');
        });
        Route::prefix('user')->group(function () {
            Route::prefix('group')->group(function () {
                route::get('/', 'User\GroupController@index')->name('core.user.group');
                route::post('/store', 'User\GroupController@store')->name('core.user.group.store');
                route::get('/delete/{id}', 'User\GroupController@delete')->name('core.user.group.delete');
                route::get('/access/{id}', 'User\GroupController@access')->name('core.user.group.access');
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
            route::get('general/{segment}', 'Config\GeneralController@index')->name('core.config.general');
            Route::get('logo', 'Config\LogoController@index')->name('core.config.logo');
        });
    });
});