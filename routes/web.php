<?php

use App\User;

$namespace = "Zngue\User\Http\Controller";
Route::namespace($namespace)->prefix('admin')->middleware(['web'])->group(function (){
    Route::get('/',function (){
        return redirect()->route('main.index');
    })->middleware('checkLogin');

    Route::prefix("login")->name('login.')->group(function (){
        Route::get("index","Login@index")->name("index");
        Route::post("doLogin",'Login@doLogin')->name('doLogin');
        Route::post('loginOut',"Login@loginOut")->name('loginOut');
    });
    Route::get("lettNav",'Index@letfNav');
    Route::middleware('checkLogin')->group(function (){
        Route::prefix('index')->name('main.')->group(function (){
            Route::get('index',"Index@index")->name('index');
            Route::get("home","Index@main")->name('home');
        });
        Route::prefix('role')->name('role.')->group(function (){//角色管理
            Route::get('index','RoleController@Index')->name('index');
            Route::post('del','RoleController@del')->name('roleDel');
            Route::post('edit','RoleController@edit')->name('editRole');
            Route::post('status','RoleController@changeStatus')->name('status');
            Route::get('add','RoleController@add')->name('add');
            Route::get('save','RoleController@save')->name('save');
            Route::post('doSave','RoleController@doSave')->name('saveRole');
            Route::get('rolePermission','RoleController@rolePermission')->name('rolePermission');
            Route::post('saveRolePermission','RoleController@saveRolePermission')->name('saveRolePermission');
        });
        Route::prefix('permission')->name('permission.')->group(function (){
            Route::get('index','PermissionController@Index')->name('index');
            Route::post('del','PermissionController@del')->name('roleDel');


            Route::get('add','PermissionController@add')->name('add');
            Route::post('edit','PermissionController@edit')->name('editRole');

            Route::get('save','PermissionController@save')->name('save');
            Route::post('status','PermissionController@changeStatus')->name('status');
            Route::post('doSave','PermissionController@doSave')->name('saveRole');
            Route::post('delAll',"PermissionController@delAll")->name('delAll');
            Route::get('ajaxList',"PermissionController@ajaxList")->name('ajaxList');
        });
        Route::prefix('user')->name('user.')->group(function (){

            Route::get('index','UserController@Index')->name('index');
            Route::post('del','UserController@del')->name('del');
            Route::get('add','UserController@add')->name('add');
            Route::post('doAdd','UserController@doAdd')->name('doAdd');
            Route::post('status','UserController@changeStatus')->name('status');

            Route::get('save','UserController@save')->name('save');
            Route::post('doSave','UserController@doSave')->name('doSave');
            Route::post('delAll',"UserController@delAll")->name('delAll');
            Route::get('getUserPermission','UserController@getUserPermission')->name('getUserPermission');
            Route::get('ajaxList',"UserController@ajaxList")->name('ajaxList');

        });


        Route::get('user',function (){
            $user =User::create([
                'name'=>'zhangsan',
                'password'=>Hash::make('123456'),
            ]);
            print_r($user);

        });

    });





});
Route::middleware('checkLogin')->get('/index',function (){
    echo 123213;die;
});
