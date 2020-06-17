<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomepageController@welcome_gallery');

Auth::routes();
Auth::routes(['verify' => true]);
//FOR SEARCHING
Route::get('/result', 'SearchController@search_media');
Route::get('/result/{id}', 'SearchController@show_media');
Route::get('/result-video/{id}', 'SearchController@show_video');


Route::get('/result-approved-image', 'SearchController@search_image_approved');
Route::get('/result-approved-image/{id}', 'SearchController@show_image_approved');

Route::get('/result-approved-video', 'SearchController@search_video_approved');
Route::get('/result-approved-video/{id}', 'SearchController@show_video_approved');

Route::get('/result-uploader-image', 'SearchController@search_image_uploader');
Route::get('/result-uploader-image/{id}', 'SearchController@show_image_uploader');

Route::get('/result-uploader-video', 'SearchController@search_video_uploader');
Route::get('/result-uploader-video/{id}', 'SearchController@show_video_uploader');

Route::get('/result-admin-image', 'SearchController@search_image_admin');
Route::get('/result-admin-image/{id}', 'SearchController@show_image_admin');

Route::get('/result-welcomepage-image', 'SearchController@search_image_welcomepage');
Route::get('/result-welcomepage-image/{id}', 'SearchController@show_image_welcomepage');


//Route::get('/mail-send','HomeController@sendemail');
Route::get('/user/verify/{token}', 'Auth\RegisterController@verifyUser');


Route::get('/home', 'HomeController@index');
//For Uploader

Route::resource('media', 'MediaController');
Route::resource('branch', 'BranchController');
//    Route::resource('add-image','AllImageController');
Route::post('media', 'MediaController@store')->name('add-media');
Route::post('branch', 'BranchController@store')->name('add-branch');



Route::post('image-upload/store', 'AllImageController@store');
Route::post('image-upload/delete', 'AllImageController@destroy');

Route::post('video-upload/store', 'AllVideoController@store');
Route::post('video-upload/delete', 'AllVideoController@destroy');

Route::put('media', 'MediaController@store')->name('add-media');
Route::get('/edit-delete/{id}', 'AllImageController@delete');
Route::get('/edit-delete-vid/{id}', 'AllVideoController@delete');

//Route::resource('thumbnail','ThumbnailController');
//Route::post('thumbnail','ThumbnailController@store')->name('add-thumbnail');


Route::resource('video', 'VideoController');
Route::post('video', 'VideoController@store')->name('add-video');


Route::get('/profile', 'ProfileController@change_details_get');
Route::get('/profile/{id}', 'ProfileController@change_details_show');
Route::post('/profile/{id}', 'ProfileController@change_details_post');
Route::get('/profile-media','ProfileController@allFiles');
Route::get('/profile-media/{id}','ProfileController@allImages_show');
Route::get('/profile-video/{id}','ProfileController@allVideos_show');
//For NTB Admin

Route::get('/add-image/create', 'AdminImageController@create');
Route::post('/add-image', 'AdminImageController@store')->name('add-image-admin');
Route::get('/add-image', 'AdminImageController@index');
Route::get('/add-image/{id}', 'AdminImageController@show');
Route::get('/add-image/{id}/edit', 'AdminImageController@edit');
Route::put('/add-image/{id}', 'AdminImageController@update');
Route::delete('/add-image/{id}', 'AdminImageController@destroy');

    Route::get('/branch-select', 'AdminController@select_pending_branch');
    Route::post('/branch-select', 'AdminController@select_pending_branch_post')->name('select-branch');

Route::get('/branch-select-video', 'AdminController@select_pending_branch_video');
Route::post('/branch-select-video', 'AdminController@select_pending_branch_video_post')->name('select-branch-video');

Route::get('/branch-image', 'AdminController@branch_image');
Route::get('/terms', 'HomeController@terms');
Route::get('/notifications', 'NotificationController@index');



Route::get('/pending-image', 'AdminController@show_pending_image_all');
Route::get('/pending-image/{id}', 'AdminController@show_pending_image_each');


Route::get('/edit-image/{id}', 'AdminController@edit_image_get');
Route::post('/edit-image/{id}', 'AdminController@edit_image_update');

Route::get('/edit-video/{id}', 'AdminController@edit_video_get');
Route::post('/edit-video/{id}', 'AdminController@edit_video_update');


Route::get('/approved-image/{id}', 'AdminController@approved_image_show');
Route::get('/approved-video/{id}', 'AdminController@approved_video_show');
Route::delete('/approved-image/{id}', 'AdminController@approved_image_delete');
Route::delete('/approved-video/{id}', 'AdminController@approved_video_delete');


Route::get('/pending-video', 'AdminController@show_pending_video_all');
Route::get('/pending-video/{id}', 'AdminController@show_pending_video_each');


Route::post('pending-image/{id}', 'AdminController@accept_pending_image');
Route::post('pending-video/{id}', 'AdminController@accept_pending_video');


Route::get('/approved-image', 'AdminController@approved_images');
Route::get('/approved-video', 'AdminController@approved_videos');
Route::post('/gallery-image/{id}', 'AdminController@gallery_image_delete');
Route::post('/gallery-video/{id}', 'AdminController@gallery_video_delete');


Route::get('/homepage', 'HomepageController@add_to_welcome_index');
Route::get('/homepage/{id}', 'HomepageController@add_to_welcome_show');
Route::get('/categories/{id}', 'HomepageController@categoryShow');
Route::post('/homepage', 'HomepageController@add_to_welcome_showPost')->name('add-to-homepage');

Route::get('/verify-users','AdminController@verify_get');
Route::post('/verify-users','AdminController@verify_post')->name('verify-users');

//For SuperAdmin

Route::get('/admin', 'SuperAdminController@admin_index');
Route::get('/admin/create', 'SuperAdminController@admin_create');
Route::post('/admin', 'SuperAdminController@admin_store')->name('add-admin');

Route::resource('terms', 'TermController');

Route::get('/admin/{id}/edit', 'SuperAdminController@admin_edit');
Route::put('/admin/{id}/edit', 'SuperAdminController@admin_update');
Route::delete('/admin/{id}', 'SuperAdminController@admin_delete');


Route::resource('category', 'CategoryController');
Route::post('category', 'CategoryController@store')->name('add-category');

Route::resource('license', 'LicenseController');
Route::post('license', 'LicenseController@store')->name('add-license');

Route::get('/users', 'UsersController@index');
Route::get('/users/{id}', 'UsersController@show');
Route::post('/users', 'UsersController@update')->name('set-permission');
Route::delete('/users/{id}', 'UsersController@delete_user');


Route::get('/permission/create', 'PermissionController@create');
Route::get('/permission', 'PermissionController@allpermissions');
Route::delete('/permission/{id}', 'PermissionController@destroy');
Route::post('/permission', 'PermissionController@postCreate')->name('add-permission');

Route::get('/role/create', 'RoleController@create');
Route::get('/role', 'RoleController@index');
Route::get('/role/{id}/edit', 'RoleController@edit');
Route::put('/role/{id}/edit', 'RoleController@update');
Route::post('/role', 'RoleController@postCreate')->name('add-role');
Route::delete('/role/{id}', 'RoleController@destroy');




