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
Auth::routes();

Route::get('/', 'MerchantController@home')->name('home');
Route::get('/home', function(){return redirect()->route('home');});



Route::get('/admin', function(){
    return redirect()->route('admin-login');
});



Route::get('/thankyou', 'MerchantController@thankYou')->name('thankyou');
Route::post('/register', 'MerchantController@register')->name('register');

Route::get('/admin/login', 'Admin\AdminsController@index')->name('admin-login');
Route::group(['prefix'=>'admin'], function () {
    Route::post('/login', 'Admin\AdminsController@login')->name('post-admin-login');
    Route::get('/dashboard', 'Admin\AdminsController@dashboard')->name('admin-dashboard');
    Route::get('/logout', 'Admin\AdminsController@logout')->name('admin-logout');
    Route::get('/profile/{id}', 'Admin\AdminsController@profile')->name('profile');
    Route::post('profile/edit', 'Admin\AdminsController@editProfile')->name('edit-profile');
    Route::get('/approve/{id}', 'Admin\AdminsController@approve')->name('approve-merchant');



    Route::get('/category', 'Admin\AdminsController@category')->name('category');

    Route::post('/category/add', 'Admin\AdminsController@addCategory')->name('add-category');

    Route::get('/category/remove/{id}', 'Admin\AdminsController@removeCategory')->name('remove-category');
    Route::get('/category/edit/{id}', 'Admin\AdminsController@editCategory')->name('edit-category');
    Route::post('/category/update/', 'Admin\AdminsController@updateCategory')->name('update-category');

});

Route::get('/final-register/{unique}', 'MerchantController@finalForm')->name('final-form');
Route::post('/final-register', 'MerchantController@finalRegistration')->name('final-registration');




Route::get('/mangopay', 'MerchantController@testMangoPay');

Route::get('/payment', 'MerchantController@showPayment')->name('payment');
Route::get('/final-payment', 'MerchantController@makePayment')->name('make-payment');

Route::get('/admin/remove/{id}', 'Admin\AdminsController@removeMerchant')->name('remove-merchant');

Route::get('/admin/view/{id}', 'Admin\AdminsController@viewMerchant')->name('view-merchant');

Route::get('/login', function(){
    return redirect('/');
});

