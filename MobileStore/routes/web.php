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
Route::post('/tim-kiem','HomeController@search');
Route::post('/autocomplete-ajax','HomeController@autocomplete_ajax');


//danh muc san pham trang chu
Route::get('/danh-muc-san-pham/{category_id}','CategoryProductsController@show_category_home');

//thuong hieu san pham trang chu
Route::get('/thuong-hieu-san-pham/{brand_id}','BrandProductsController@show_brand_home');

//chi tiet san pham trang chu
Route::get('/chi-tiet-san-pham/{product_id}','ProductsController@detail_product');



//backend
Route::get('/dashboard','AdminController@show_dashboard');
Route::get('/logout','AdminController@logout');
Route::post('/admin-dashboard','AdminController@dashboard');
Route::post('/days-order','AdminController@days_order');
Route::post('/filter-by-date','AdminController@filter_by_date');
Route::post('/dashboard-filter','AdminController@dashboard_filter');


//categoryproducts
Route::group(['middleware' => 'auth.roles'], function() {
    Route::get('/add_categoryproducts','CategoryProductsController@add_categoryproducts');
    Route::get('/all_categoryproducts','CategoryProductsController@all_categoryproducts');
    Route::get('/unactive_categoryproducts/{category_id}','CategoryProductsController@unactive_categoryproducts');
    Route::get('/active_categoryproducts/{category_id}','CategoryProductsController@active_categoryproducts');
    Route::post('/postadd_categoryproducts','CategoryProductsController@postadd_categoryproducts');
    Route::get('/edit_categoryproducts/{category_id}','CategoryProductsController@edit_categoryproducts');
    Route::post('/update_categoryproducts/{category_id}','CategoryProductsController@update_categoryproducts');
    Route::get('/delete_categoryproducts/{caterory_id}','CategoryProductsController@delete_categoryproducts');
});


//Coupon -- backend
    Route::get('/add_coupon', 'CouponController@add_coupon');

    Route::post('/postadd_coupon', 'CouponController@postadd_coupon');

    Route::get('/all_coupon', 'CouponController@all_coupon');

    Route::get('/delete_coupon/{coupon_id}', 'CouponController@delete_coupon');

//Coupon -- frontend
Route::post('/check-coupon','CartController@check_coupon');
Route::get('/unset-coupon','CartController@unset_coupon');


//brandproducts
Route::group(['middleware' => 'auth.roles'], function() {
    Route::get('/add_brandproducts','BrandProductsController@add_brandproducts');
    Route::get('/all_brandproducts','BrandProductsController@all_brandproducts');
    Route::get('/unactive_brandproducts/{brand_id}','BrandProductsController@unactive_brandproducts');
    Route::get('/active_brandproducts/{brand_id}','BrandProductsController@active_brandproducts');
    Route::post('/postadd_brandproducts','BrandProductsController@postadd_brandproducts');
    Route::get('/edit_brandproducts/{brand_id}','BrandProductsController@edit_brandproducts');
    Route::post('/update_brandproducts/{brand_id}','BrandProductsController@update_brandproducts');
    Route::get('/delete_brandproducts/{brand_id}','BrandProductsController@delete_brandproducts');
});


//Products
Route::group(['middleware' => 'auth.roles'], function() {
    Route::get('/add_products','ProductsController@add_products');
    Route::get('/all_products','ProductsController@all_products');
    Route::get('/unactive_products/{product_id}','ProductsController@unactive_products');
    Route::get('/active_products/{product_id}','ProductsController@active_products');
    Route::post('/postadd_products','ProductsController@postadd_products');
    Route::get('/edit_products/{product_id}','ProductsController@edit_products');
    Route::post('/update_products/{product_id}','ProductsController@update_products');
    Route::get('/delete_products/{prodcut_id}','ProductsController@delete_products');
    Route::post('/export-product','ProductsController@export_product');
    Route::post('/quickview','ProductsController@quickview');
    Route::get('/comment','ProductsController@list_comment');
    Route::get('/delete-comment/{comment_id}','ProductsController@delete_comment');
    Route::post('/load-comment','ProductsController@load_comment');
    Route::post('/send-comment','ProductsController@send_comment');
    Route::post('/allow-comment','ProductsController@allow_comment');
    Route::post('/reply-comment','ProductsController@reply_comment');
    Route::post('/insert-rating','ProductsController@insert_rating');
});

Route::post('/quickview','ProductsController@quickview');
Route::get('/comment','ProductsController@list_comment');
Route::get('/delete-comment/{comment_id}','ProductsController@delete_comment');
Route::post('/load-comment','ProductsController@load_comment');
Route::post('/send-comment','ProductsController@send_comment');
Route::post('/allow-comment','ProductsController@allow_comment');
Route::post('/reply-comment','ProductsController@reply_comment');

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
Route::post('/update-order-qty','OrderController@update_order_qty');
Route::post('/update-qty','OrderController@update_qty');
//slider
Route::get('/all_banner', 'SliderController@manage_banner');
Route::get('/add_banner','SliderController@add_banner');
Route::post('/postadd_banner','SliderController@postadd_banner');
Route::get('/unactive_banner/{slider_id}','SliderController@unactive_banner');
Route::get('/active_banner/{slider_id}','SliderController@active_banner');
Route::get('/delete_banner/{slider_id}','SliderController@delete_banner');

//customer
Route::get('/all_customer','CustomerConTroller@all_customers');
Route::get('/edit_customers/{customer_id}','CustomerConTroller@edit_customers');
Route::post('/update_customers/{customer_id}','CustomerConTroller@update_customers');
Route::get('/delete_customers/{customer_id}','CustomerConTroller@delete_customers');

//authentication role
Route::get('/register-auth','AuthController@register_auth');
Route::get('/login-auth','AuthController@login_auth');
Route::get('/logout-auth','AuthController@logout_auth');

Route::post('/register','AuthController@register');
Route::post('/login','AuthController@login');

Route::get('users','UserController@index');
Route::get('add-users','UserController@add_users');
Route::post('store-users','UserController@store_users');
Route::get('delete-user-roles/{admin_id}','UserController@delete_user_roles')->middleware('auth.roles');
Route::post('assign-roles','UserController@assign_roles')->middleware('auth.roles');
Route::get('impersonate/{admin_id}','UserController@impersonate');


//thong tin lien he
Route::get('/lien-he','ContactController@lien_he' );
Route::get('/information','ContactController@information' );
Route::post('/save-info','ContactController@save_info' );
Route::post('/update-info/{info_id}','ContactController@update_info');

//Gallery
Route::get('/add-gallery/{product_id}','GalleryController@add_gallery');
Route::post('/select-gallery','GalleryController@select_gallery');
Route::post('/insert-gallery/{pro_id}','GalleryController@insert_gallery');
Route::post('/update-gallery-name','GalleryController@update_gallery_name');
Route::post('/delete-gallery','GalleryController@delete_gallery');
Route::post('update-gallery','GalleryController@update_gallery');

