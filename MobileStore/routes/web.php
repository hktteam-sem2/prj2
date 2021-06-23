<?php

use Illuminate\Support\Facades\Route;

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

//frontend
Route::get('/', 'HomeController@index');
Route::get('/trang-chu','HomeController@index');

//danh muc san pham trang chu
Route::get('/danh-muc-san-pham/{category_id}','CategoryProductsController@show_category_home');

//thuong hieu san pham trang chu
Route::get('/thuong-hieu-san-pham/{brand_id}','BrandProductsController@show_brand_home');

//chi tiet san pham trang chu
Route::get('/chi-tiet-san-pham/{product_id}','ProductsController@detail_product');



//backend
Route::get('/admin','AdminController@login');
Route::post('/postlogin','AdminController@postlogin');
Route::get('/logout','AdminController@logout');
Route::get('/dashboard','AdminController@showDasboard');


//categoryproducts
Route::get('/add_categoryproducts','CategoryProductsController@add_categoryproducts');

Route::get('/all_categoryproducts','CategoryProductsController@all_categoryproducts');

Route::get('/unactive_categoryproducts/{category_id}','CategoryProductsController@unactive_categoryproducts');

Route::get('/active_categoryproducts/{category_id}','CategoryProductsController@active_categoryproducts');

Route::post('/postadd_categoryproducts','CategoryProductsController@postadd_categoryproducts');

Route::get('/edit_categoryproducts/{category_id}','CategoryProductsController@edit_categoryproducts');

Route::post('/update_categoryproducts/{category_id}','CategoryProductsController@update_categoryproducts');

Route::get('/delete_categoryproducts/{caterory_id}','CategoryProductsController@delete_categoryproducts');

//Coupon -- backend
Route::get('/add_coupon','CouponController@add_coupon');

Route::post('/postadd_coupon','CouponController@postadd_coupon');

Route::get('/all_coupon','CouponController@all_coupon');

Route::get('/delete_coupon/{coupon_id}','CouponController@delete_coupon');

//Coupon -- frontend
Route::post('/check-coupon','CartController@check_coupon');

Route::get('/unset-coupon','CartController@unset_coupon');


//brandproducts
Route::get('/add_brandproducts','BrandProductsController@add_brandproducts');

Route::get('/all_brandproducts','BrandProductsController@all_brandproducts');

Route::get('/unactive_brandproducts/{brand_id}','BrandProductsController@unactive_brandproducts');

Route::get('/active_brandproducts/{brand_id}','BrandProductsController@active_brandproducts');

Route::post('/postadd_brandproducts','BrandProductsController@postadd_brandproducts');

Route::get('/edit_brandproducts/{brand_id}','BrandProductsController@edit_brandproducts');

Route::post('/update_brandproducts/{brand_id}','BrandProductsController@update_brandproducts');

Route::get('/delete_brandproducts/{brand_id}','BrandProductsController@delete_brandproducts');


//Products
Route::get('/add_products','ProductsController@add_products');

Route::get('/all_products','ProductsController@all_products');

Route::get('/unactive_products/{product_id}','ProductsController@unactive_products');

Route::get('/active_products/{product_id}','ProductsController@active_products');

Route::post('/postadd_products','ProductsController@postadd_products');

Route::get('/edit_products/{product_id}','ProductsController@edit_products');

Route::post('/update_products/{product_id}','ProductsController@update_products');

Route::get('/delete_products/{prodcut_id}','ProductsController@delete_products');

Route::post('/export-product','ProductsController@export_product');

//cart
Route::post('/add_cart','CartController@add_cart');
Route::get('/show_cart','CartController@show_cart');
Route::get('/delete_to_cart/{rowId}','CartController@delete_cart');
Route::post('/update_cart_quantity','CartController@update_cart_quantity');

//cart - ajax
Route::post('/add-cart-ajax','CartController@add_cart_ajax');
Route::get('/gio-hang','CartController@show_cart_ajax');
Route::get('/delete-cart-product/{session_id}','CartController@delete_cart_ajax');
Route::get('/delete-all-cart','CartController@delete_all_cart_ajax');
Route::post('/update-cart-product-qty','CartController@update_cart_ajax');



//check out (thanh toan)
Route::get('/login_checkout', 'CheckOutController@checkout_login');
Route::get('/logout_checkout', 'CheckOutController@checkout_logout');
Route::post('/login_customer','CheckOutController@login_customer');
Route::post('/add_customer','CheckOutController@add_customer');
Route::get('/show_checkout', 'CheckOutController@checkout');
Route::post('/save_checkout','CheckOutController@save_checkout');
Route::get('/payment', 'CheckOutController@payment');
Route::post('/order_place','CheckOutController@order_place');
Route::post('/confirm-order','CheckOutController@confirm_order');

//order
Route::get('/order', 'OrderController@order');

Route::get('/order_details/{order_code}','OrderController@order_details');

Route::get('/print_order/{check_code}', 'OrderController@print_order');

//slider
Route::get('/all_banner', 'SliderController@manage_banner');
Route::get('/add_banner','SliderController@add_banner');
Route::post('/postadd_banner','SliderController@postadd_banner');
Route::get('/unactive_banner/{slider_id}','SliderController@unactive_banner');
Route::get('/active_banner/{slider_id}','SliderController@active_banner');
Route::get('/delete_banner/{slider_id}','SliderController@delete_banner');




