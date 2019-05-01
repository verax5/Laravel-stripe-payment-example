<?php

Route::get('/', 'ProductsController@index')->name('home');

Route::get('user/register', 'RegisterController@userRegisterView')->name('user.register');
Route::post('user/register', 'RegisterController@userRegister')->name('user.register');
Route::get('user/login', 'LoginController@userLoginView')->name('user.login');
Route::post('user/login', 'LoginController@userLogin')->name('user.login');
Route::get('user/logout', 'LoginController@userLogout')->name('user.logout');
Route::get('user/confirm', 'RegisterController@confirmAccount')->name('confirm.account');

Route::get('contact', 'ContactController@index')->name('contact');
Route::post('contact', 'ContactController@send')->name('contact');

Route::get('admin/login', 'LoginController@adminLoginView')->name('admin.login');
Route::post('admin/login', 'LoginController@adminLogin')->name('admin.login');
Route::get('admin/logout', 'LoginController@adminLogout')->name('admin.logout');

Route::get('admin', 'AdminController@index')->name('admin');

Route::get('admin/add-product', 'ProductsController@addProductView')->name('add.product')->middleware('admin');
Route::post('admin/add-product', 'ProductsController@preAddNewProduct')->name('add.product')->middleware('admin');

Route::get('products/{slug}/{id}', 'ProductsController@product')->name('expand.product');

Route::get('members-products', 'ProductsController@membersProducts')->name('members.products');

Route::get('become-a-member', 'RegisterController@becomeAMember')->name('become.a.member');

Route::get('subscribe', 'ProductsController@subscribePage')->name('subscribe');
Route::post('subscribe', 'ProductsController@subscribe')->name('subscribe');
Route::get('subscriber-area', 'ProductsController@subscriberArea')->name('subscriber.area');
Route::get('download-ebook/{product_id}', 'ProductsController@downloadEbook')->name('download.ebook');

Route::get('category/{slug}/{id}', 'ProductsController@expandCategory')->name('expand.category');

Route::prefix('admin/test')->group(function() {
    Route::get('confirm-account-template', 'MailTemplatesController@confirm');
});

