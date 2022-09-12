<?php

use App\Http\Controllers\Admin\VideoController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\UserController;

Route::get('/admin-login', function () {
    return view('admin.login');
})->name('admin-login');

Route::group(['namespace' => 'Auth'], function () {
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login');
    Route::post('logout', 'LoginController@logout')->name('logout');
});

Route::group(['middleware' => 'auth:admin'], function () {
    Route::get('/index', function () {
        return view('admin.index');
    });
    Route::get('/video-upload', function () {
        return view('admin.form.video_upload_form');
    });
 
    Route::post('videoUpload', [VideoController::class, 'store'])->name('videoUpload');
    Route::get('video-list', [VideoController::class, 'index'])->name('video-list');
    Route::get('/edit-video/{video}', [VideoController::class, 'edit'])->name('video_edit');
    Route::post('edit-video', [VideoController::class, 'update'])->name('edit-video');
    Route::get('/destroy/{video}', [VideoController::class, 'destroy'])->name('destroy');
    

    Route::get('/setting/{setting}', [UserController::class, 'editSettingDetails'])->name('edit_setting');
    Route::get('/aboutus/{aboutus}', [UserController::class, 'editaboutusDetails'])->name('edit_aboutus');
    Route::post('setting', [UserController::class, 'updateSettingDetails'])->name('update_setting');
    Route::post('aboutus', [UserController::class, 'updateAboutusDetails'])->name('update_aboutus');
    //user Routes
    Route::get('user-list', [UserController::class, 'showUserData'])->name('user-list');
    
    Route::get('/edit-user/{user}', [UserController::class, 'editUserData']);
    Route::post('edit-user', [UserController::class, 'updateUserData'])->name('edit-user');
    Route::get('/delete-user/{user}', [UserController::class, 'destroyUserData'])->name('delete-user');
    Route::get('/profile-user/{user}', [UserController::class, 'profileUserData']);
});





