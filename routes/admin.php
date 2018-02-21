<?php

    /*
    |--------------------------------------------------------------------------
    | Admin Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register web routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | contains the "web" middleware group. Now create something great!
    |
    */

    Route::get('/admin/login', 'Admin\AuthController@login');
    Route::post('/admin/CheckLogin', 'Admin\AuthController@CheckLogin');
    Route::get('/admin/debug', function(){
        return view('debug');
    });


    Route::group(['middleware' => 'admin_auth','prefix' => 'admin'], function(){
        Route::get('/', 'Admin\HomeController@index');
        Route::get('/logout', 'Admin\AuthController@logout');
        Route::get('/dashboard', 'Admin\HomeController@index');

        Route::post('/upload_file', 'Admin\UploadFileController@index');



        //User
        Route::get('/change_password', 'Admin\UserController@change_password');
        Route::get('/profile', 'Admin\UserController@profile');
        Route::get('/user/ListUser', 'Admin\UserController@ListUser');
        Route::post('/user/change_password', 'Admin\UserController@change_password');
        Route::post('/user/checkedit/{id}', 'Admin\UserController@update');
        Route::post('/user/delete/{id}', 'Admin\UserController@destroy');
        Route::resource('/user', 'Admin\UserController');
        // Route::get('/user', 'Admin\UserController@index');
        Route::get('/logout', 'Admin\AuthController@logout');

        //ManageMenu
        Route::get('/ManageMenu', 'Admin\MenuController@index');
        Route::get('/menu/ListMenu', 'Admin\MenuController@ListMenu');
        Route::post('/menu', 'Admin\MenuController@store');
        Route::get('/menu/{id}', 'Admin\MenuController@edit');
        Route::post('/menu/checkedit/{id}', 'Admin\MenuController@update');
        Route::post('/menu/delete/{id}', 'Admin\MenuController@destroy');

        //SetPermission
        Route::post('/SetPermission', 'Admin\MenuController@SetPermission');
        Route::post('/GetPermission/{id}', 'Admin\MenuController@GetPermission');

        Route::get('/Install', 'Admin\InstallController@index');
        Route::get('/Install/DefaultView', 'Admin\InstallController@DefaultView');
        Route::post('/Install/GetFieldDropDown', 'Admin\InstallController@GetFieldDropDown');
        Route::post('/Install/GetField/{table}', 'Admin\InstallController@GetField');
        Route::post('/Install', 'Admin\InstallController@Install');

        Route::get('/Menu', 'Admin\MenuController@index');
        Route::get('/Menu/Lists', 'Admin\MenuController@Lists');
        Route::post('/Menu', 'Admin\MenuController@store');
        Route::get('/Menu/{id}', 'Admin\MenuController@show');
        Route::post('/Menu/{id}', 'Admin\MenuController@update');
        Route::post('/Menu/Delete/{id}', 'Admin\MenuController@destroy');

    Route::get('/AdminUser', 'Admin\AdminUserController@index');
        Route::get('/AdminUser/Lists', 'Admin\AdminUserController@Lists');
        Route::post('/AdminUser', 'Admin\AdminUserController@store');
        Route::get('/AdminUser/{id}', 'Admin\AdminUserController@show');
        Route::post('/AdminUser/{id}', 'Admin\AdminUserController@update');
        Route::post('/AdminUser/Delete/{id}', 'Admin\AdminUserController@destroy');

      Route::get('/Test', 'Admin\TestController@index');
        Route::get('/Test/Lists', 'Admin\TestController@Lists');
        Route::post('/Test', 'Admin\TestController@store');
        Route::get('/Test/{id}', 'Admin\TestController@show');
        Route::post('/Test/{id}', 'Admin\TestController@update');
        Route::post('/Test/Delete/{id}', 'Admin\TestController@destroy');

      Route::get('/Test', 'Admin\TestController@index');
        Route::get('/Test/Lists', 'Admin\TestController@Lists');
        Route::post('/Test', 'Admin\TestController@store');
        Route::get('/Test/{id}', 'Admin\TestController@show');
        Route::post('/Test/{id}', 'Admin\TestController@update');
        Route::post('/Test/Delete/{id}', 'Admin\TestController@destroy');

      Route::get('/Test', 'Admin\TestController@index');
        Route::get('/Test/Lists', 'Admin\TestController@Lists');
        Route::post('/Test', 'Admin\TestController@store');
        Route::get('/Test/{id}', 'Admin\TestController@show');
        Route::post('/Test/{id}', 'Admin\TestController@update');
        Route::post('/Test/Delete/{id}', 'Admin\TestController@destroy');

      Route::get('/Employee', 'Admin\EmployeeController@index');
        Route::get('/Employee/Lists', 'Admin\EmployeeController@Lists');
        Route::post('/Employee', 'Admin\EmployeeController@store');
        Route::get('/Employee/{id}', 'Admin\EmployeeController@show');
        Route::post('/Employee/{id}', 'Admin\EmployeeController@update');
        Route::post('/Employee/Delete/{id}', 'Admin\EmployeeController@destroy');

      Route::get('/UserDepartment', 'Admin\UserDepartmentController@index');
        Route::get('/UserDepartment/Lists', 'Admin\UserDepartmentController@Lists');
        Route::post('/UserDepartment', 'Admin\UserDepartmentController@store');
        Route::get('/UserDepartment/{id}', 'Admin\UserDepartmentController@show');
        Route::post('/UserDepartment/{id}', 'Admin\UserDepartmentController@update');
        Route::post('/UserDepartment/Delete/{id}', 'Admin\UserDepartmentController@destroy');

      Route::get('/Guest', 'Admin\GuestController@index');
        Route::get('/Guest/Lists', 'Admin\GuestController@Lists');
        Route::post('/Guest', 'Admin\GuestController@store');
        Route::get('/Guest/{id}', 'Admin\GuestController@show');
        Route::post('/Guest/{id}', 'Admin\GuestController@update');
        Route::post('/Guest/Delete/{id}', 'Admin\GuestController@destroy');

      Route::get('/Activities', 'Admin\ActivitiesController@index');
        Route::get('/Activities/Lists', 'Admin\ActivitiesController@Lists');
        Route::post('/Activities', 'Admin\ActivitiesController@store');
        Route::get('/Activities/{id}', 'Admin\ActivitiesController@show');
        Route::post('/Activities/{id}', 'Admin\ActivitiesController@update');
        Route::post('/Activities/Delete/{id}', 'Admin\ActivitiesController@destroy');

      ##ROUTEFORINSTALL##
      Route::get('/Question', 'Admin\QuestionController@index');
        Route::get('/Question/Lists', 'Admin\QuestionController@Lists');
        Route::post('/Question', 'Admin\QuestionController@store');
        Route::get('/Question/{id}', 'Admin\QuestionController@show');
        Route::post('/Question/{id}', 'Admin\QuestionController@update');
        Route::post('/Question/Delete/{id}', 'Admin\QuestionController@destroy');

        Route::get('/Reward', 'Admin\RewardController@index');
        Route::get('/Reward/Lists', 'Admin\RewardController@Lists');
        Route::post('/Reward', 'Admin\RewardController@store');
        Route::post('/Reward/Import', 'Admin\RewardController@Import');
        Route::post('/Reward/Export', 'Admin\RewardController@Export');
        Route::get('/Reward/{id}', 'Admin\RewardController@show');
        Route::post('/Reward/{id}', 'Admin\RewardController@update');
        Route::post('/Reward/Delete/{id}', 'Admin\RewardController@destroy');

    });

    //OrakUploader
    Route::any('/upload_file', 'OrakController@upload_file');

    //Laravel Filemanager
    Route::get('admin/laravel-filemanager', '\Unisharp\Laravelfilemanager\controllers\LfmController@show');
    Route::post('admin/laravel-filemanager/upload', '\Unisharp\Laravelfilemanager\controllers\UploadController@upload');
?>
