<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::group([

    'namespace'  => 'App\Http\Controllers',

],function ($router) {

    Route::get ('/login'                       , 'ViewController@login')->name('login');

    Route::get ('/register'                    , 'ViewController@register')->name('register');

    Route::post ('/main/doLogin'            , 'AuthController@doLogin')->name('doLogin');

    Route::get ('/main/logout'                  ,'AuthController@doLogout');

    Route::post ('/main/doRegister'            , 'ActionController@doRegister')->name('doRegister');

});


Route::group([

    'middleware' => 'authroute',
    'namespace'  => 'App\Http\Controllers',

],function ($router) {

    Route::get ('/'                            , 'ViewController@dashboard')->name('dashboard');

    Route::get ('/user-create'                 , 'ViewController@userCreate')->name('user-create');

    Route::get ('/user-list'                    , 'ViewController@userList')->name('user-list');

    Route::get ('/user-edit/{id?}'             , 'ViewController@useredit')->name('user-edit');

    Route::get ('/user-role'                    , 'ViewController@userRole')->name('user-role');

    Route::get ('/user-role-edit/{id}'          , 'ViewController@userRoleEdit')->name('user-role-edit');

    Route::get ('/user-profile'                    , 'ViewController@userProfile')->name('user-profile');

    Route::get ('/task-create'                    , 'ViewController@taskCreate')->name('task-create');

    Route::get ('/task-edit/{id?}'                 , 'ViewController@taskEdit')->name('task-edit');

    Route::get ('/my-tasks'                    , 'ViewController@myTasks')->name('my-tasks');

    Route::get ('/my-tasks/{id}'                    , 'AjaxController@myTasks');

});


Route::group([

    'middleware' => 'authaction',
    'namespace'  => 'App\Http\Controllers',

],function ($router) {

    Route::post ('/main/updateUser/{id}'         , 'ActionController@updateUser')->name('updateUser');

    Route::delete ('/user-delete/{id}'             , 'AjaxController@deleteUser')->name('deleteUser');

    Route::post ('/createUserRole'             , 'ActionController@createUserRole')->name('createUserRole');

    Route::post ('/edit_user_role_permissions'     , 'ActionController@editUserRolePermissions')->name('editUserRolePermissions');

    Route::post ('/addClient'                   , 'ActionController@createClient')->name('createClient');

    Route::post ('/addProject'                   , 'ActionController@createProject')->name('createProject');

    Route::post ('/projectUpdate'                 , 'AjaxController@updateProject')->name('updateProject');

    Route::post ('/save-attendance'             , 'AjaxController@saveAttendance')->name('saveAttendance');

    Route::post ('/createTask'                 , 'ActionController@createTask')->name('createTask');

    Route::post ('/updateTask/{id}'                 , 'ActionController@updateTask')->name('updateTask');

    Route::post ('/change-password'                 , 'ActionController@changePassword')->name('change-password');

    Route::post('/check-current-password'       , 'AjaxController@checkCurrentPassword')->name('check-current-password');


    Route::post('/my-tasks/{task}/complete'          , 'AjaxController@completeTask');
    Route::post('/my-tasks/{task}/cancel'           , 'AjaxController@cancelTask');

});
