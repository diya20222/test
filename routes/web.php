<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Login;
use Laravel\Socialite\Facades\Socialite;
// front-end work

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('user-login-page', function () {
    return view('front.form.login_form');
})->name('login-user');
Route::post('login', function () {
    return view('front.home');
})->name('login');

Route::get('user-register-page', function () {  
    return view('front.form.register_form');
});
Route::get('about-us','HomeController@abouteUs')->name('about-us-detail');
//redirect detail
Route::get('/detail/{slug}', 'HomeController@details')->name('detail');





Route::group(['middleware' => 'auth:web'], function () {
    Route::get('user-profile', function () {
        return view('front.form.profile_form');
    })->name('user-profile');

    Route::any('user-edit', function () {
        return view('front.form.edit_form');
    })->name('user-edit');
    Route::get('user-upload-video', function () {
        return view('front.form.upload_video_form');
    })->name('user-upload-video');
    
    Route::get('user-videos', 'HomeController@user_video')->name('user-videos');
    Route::get('detail/edit-comment/{slug}', 'HomeController@user_comments')->name('edit-comment');
    Route::get('/user_like/{id}', 'HomeController@user_likes')->name('user_like');
    Route::get('/user_dislike/{id}', 'HomeController@user_dislikes')->name('user_dislike');
    Route::post('commentSubmit/{id}', 'HomeController@user_comments')->name('commentSubmit');
    //User Chnage Password
    Route::get('/change-password/{user}', 'HomeController@user_change_passwod')->name('change-password');
    Route::post('submit-change-password', 'HomeController@user_edit_password');
    //user Delete Comment
    Route::post('detail/delete-comment', 'HomeController@delete_comments')->name('delete-comment-user');
    Route::post('submit-upload-video', 'HomeController@store')->name('store.video');
    Route::post('submit-edit', [HomeController::class, 'updateAccount']);
    Route::get('/user-edit-video/{video}', [HomeController::class, 'edit_video']);
    Route::get('/user-delete-video/{id}', [HomeController::class, 'delete_video'])->name('delete-video');
    Route::post('user-edit-video', [HomeController::class, 'update_video']);
    
});

//example forget password
Route::get('/forgot-password', function () {
    return view('front.auth.forgot-password');
})->middleware('guest')->name('password.request');
//Password Reset Link
Route::get('/password_reset_link', function () {
    return view('front.auth.passwords.reset');
})->name('password-reset-link');

Route::namespace('\App\Http\Controllers')->group(function () {
    Auth::routes();
});

//LOGIN WITH GOOGLE 
Route::get('login/google', [LoginController::class, 'redirectToGoogle'])->name('google');
Route::get('login/google/callback', [LoginController::class, 'handleGoogleCallback']);




    // $user->token

