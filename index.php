<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

require_once './config.php';
require_once './Core/Application.php';

$app = new Application();

//  =========================== Admin ===========================

// Home Dashboard
$app->router->get('/admin', 'DashboardController@index');

// Product 
$app->router->get('/admin/product', 'ProductController@index');
$app->router->get('/admin/product/:id', 'ProductController@show');
$app->router->get('/admin/product/create', 'ProductController@create');
$app->router->get('/admin/product/:id/edit', 'ProductController@edit');
$app->router->post('/admin/product/store', 'ProductController@store');
$app->router->post('/admin/product/:id/update', 'ProductController@update');
$app->router->post('/admin/product/:id/delete', 'ProductController@destroy');

// Category
$app->router->get('/admin/category', 'CategoryController@index');
$app->router->get('/admin/category/:id', 'CategoryController@show');
$app->router->get('/admin/category/create', 'CategoryController@create');
$app->router->get('/admin/category/:id/edit', 'CategoryController@edit');
$app->router->post('/admin/category/store', 'CategoryController@store');
$app->router->post('/admin/category/:id/update', 'CategoryController@update');
$app->router->post('/admin/category/:id/delete', 'CategoryController@destroy');

// Coupon
$app->router->get('/admin/coupon', 'CouponController@index');
$app->router->get('/admin/coupon/:id', 'CouponController@show');
$app->router->get('/admin/coupon/create', 'CouponController@create');
$app->router->get('/admin/coupon/:id/edit', 'CouponController@edit');
$app->router->post('/admin/coupon/store', 'CouponController@store');
$app->router->post('/admin/coupon/:id/update', 'CouponController@update');
$app->router->post('/admin/coupon/:id/delete', 'CouponController@destroy');

// User
$app->router->get('/admin/user', 'UserController@index');
$app->router->get('/admin/user/:id', 'UserController@show');
$app->router->get('/admin/user/create', 'UserController@create');
$app->router->get('/admin/user/:id/edit', 'UserController@edit');
$app->router->post('/admin/user/store', 'UserController@store');
$app->router->post('/admin/user/:id/update', 'UserController@update');
$app->router->post('/admin/user/:id/delete', 'UserController@destroy');
$app->router->post('/admin/user/:id/change-password', 'UserController@updatePassword');

// Order
$app->router->get('/admin/order', 'OrderController@index');
$app->router->get('/admin/order/:id', 'OrderController@show');
$app->router->get('/admin/order/:id/edit', 'OrderController@edit');
$app->router->post('/admin/order/:id/update', 'OrderController@update');
//  =========================== Admin ===========================

//  =========================== Site  ===========================

// Home
$app->router->get('/', 'HomeController@index');
$app->router->get('/index-ajax', 'HomeController@getListByAjax');
$app->router->get('/about', 'HomeController@about');
$app->router->get('/contact', 'HomeController@contact');

// Product
$app->router->get('/products', 'HomeController@getAllProduct');
$app->router->get('/search', 'HomeController@searchProduct');
$app->router->get('/product/:slug', 'HomeController@detailProduct');
$app->router->get('/category/:slug', 'HomeController@detailCategory');

// Auth
$app->router->get('/login', 'AuthController@login');
$app->router->get('/register', 'AuthController@register');
$app->router->post('/login', 'AuthController@handleLogin');
$app->router->post('/register', 'AuthController@handleRegister');
$app->router->get('/register-success', 'AuthController@registerSuccess');
$app->router->post('/logout', 'AuthController@handleLogout');

// User
$app->router->get('/profile', 'HomeController@profile');
$app->router->post('/profile', 'HomeController@updateProfile');
$app->router->post('/profile/:id/change-password', 'HomeController@updatePassword');
$app->router->post('/profile/:id/change-avatar', 'HomeController@updateAvatar');

// Cart
$app->router->get('/cart', 'HomeController@cart');
$app->router->post('/cart/add', 'CartController@addCart');
$app->router->post('/cart/update', 'CartController@updateCart');
$app->router->post('/cart/remove', 'CartController@removeCart');

// Checkout
$app->router->get('/checkout', 'HomeController@checkout');
$app->router->post('/checkout', 'HomeController@handleCheckout');

// Address
$app->router->post('/address/district', 'AddressController@getListDistricts');
$app->router->post('/address/ward', 'AddressController@getListWards');

// Order
$app->router->get('/order', 'HomeController@orderList');
$app->router->get('/order/:id', 'HomeController@orderDetail');
$app->router->get('/order-success', 'HomeController@orderSuccess');

// Not found
$app->router->setNotFound('ErrorController@notFound');
$app->run();
