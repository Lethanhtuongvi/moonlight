<?php

use App\Http\Controllers\CategoryPost;
use App\Http\Controllers\ProductController;
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

# frontend 


# trang chủ 
Route::get('/','HomeController@index');
Route::get('/get_sp','HomeController@get_sp');
Route::get('/trang-chu','HomeController@index');
Route::post('/tiem-kiem','HomeController@search');




# category_home
Route::get('/danh-muc-san-pham/{category_id}','CategoryProduct@show_category_home');
Route::get('/chi-tiet-san-pham/{product_id}','ProductController@detials_product');

#bài viết 

Route::get('/danh-muc-bai-viet','PostController@danh_muc_bai_viet');
Route::get('/bai-viet/{post_id}','PostController@bai_viet');
Route::get('/chi-tiet-bai-viet/{post_id}','PostController@chi_tiet_bai_viet');












#admin 
Route::get('/admin','AdminController@index');
Route::get('/dashboard','AdminController@show_dasboard');
Route::get('/log_out','AdminController@log_out');
Route::post('/admin-dashboard','AdminController@dashboard');

# category_product  nơi khai báo đường dẫn dẫn 
# phương thức get() bảo mật hơn phương thức post() 

# category 
Route::get('/add_category_product','CategoryProduct@add_category_product');
Route::get('/edit-category-product/{category_product_id}','CategoryProduct@edit_category_product');
Route::get('/delete-category-product/{category_product_id}','CategoryProduct@delete_category_product');
Route::get('/all_category_product','CategoryProduct@all_category_product');

Route::get('/unactive-category-product/{category_product_id}','CategoryProduct@unactive_category_product');
Route::get('/active-category-product/{category_product_id}','CategoryProduct@active_category_product');

Route::post('/save-category-product','CategoryProduct@save_category_product');
Route::post('/update-category-product/{category_product_id}','CategoryProduct@update_category_product');


# product 
Route::get('/add_product' , 'ProductController@add_product');
Route::get('/edit-product/{product_id}','ProductController@edit_product');
Route::get('delete-product/{product_id}','ProductController@delete_product');
Route::get('/all_product' , 'ProductController@all_product');

Route::get('/unactive-product/{product_id}','ProductController@unactive_product');
Route::get('/active-product/{product_id}','ProductController@active_product');

Route::post('/save_product' , 'ProductController@save_product');
Route::post('/update-product/{product_id}','ProductController@update_product');

# cart
Route::post('/update-cart-quantity','CartController@update_cart_quantity');
Route::post('/update-cart','CartController@update_cart');
Route::post('/save-cart','CartController@save_cart');

Route::post('/add-cart-ajax','CartController@add_cart_ajax');
Route::get('/gio-hang','CartController@gio_hang');
Route::get('/del-product/{session_id}','CartController@delete_product');
Route::get('/del-all-product','CartController@delete_all_product');

Route::get('/show-cart','CartController@show_cart');
Route::get('/delete-to-cart/{rowId}','CartController@delete_to_cart');
#check
Route::get('/login-checkout','CheckoutController@login_checkout');
Route::get('//logout-checkout','CheckoutController@logout_checkout');
Route::post('/add-customer','CheckoutController@add_customer');
Route::post('/login-customer','CheckoutController@login_customer');
Route::get('/checkout','CheckoutController@checkout');
Route::get('/payment','CheckoutController@payment');
Route::post('/order-place','CheckoutController@order_place');
Route::post('/save-checkout-customer','CheckoutController@save_checkout_customer');

Route::post('/confirm-order','CheckoutController@confirm_order');


# Order

Route::get('/manage-order','OrderController@manage_order');
Route::get('/view-order/{order_code}','OrderController@view_order');



#coupon 

Route::post('/check-coupon','CartController@check_coupon');

Route::get('/insert-coupon','CouponController@insert_coupon');
Route::get('/list-coupon','CouponController@list_coupon');
Route::get('/delete-coupon/{coupon_id}','CouponController@delete_coupon');
Route::get('/unset-coupon','CouponController@unset_coupon');

Route::post('/insert-coupon-code','CouponController@insert_coupon_code');

# Post 

Route::get('/add-post','PostController@add_post');
Route::post('/save-post','PostController@save_post');
Route::get('/all-post','PostController@all_post');

Route::get('/edit-post/{post_id}','PostController@edit_post');
Route::get('delete-post/{post_id}','PostController@delete_post');

Route::post('/update-post/{post_id}','PostController@update_post');



//Liên hệ
Route::get('/lien-he','ContactController@lien_he');
Route::get('/information','ContactController@information');
Route::post('/save-info','ContactController@save_info');
Route::post('/update-info/{info_id}','ContactController@update_info');

