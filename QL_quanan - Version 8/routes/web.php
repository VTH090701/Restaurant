<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\QuantitativeController;
use App\Models\Quantitative;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Frontend
Route::get('/', [App\Http\Controllers\UserController::class, 'index']);
Route::get('/step-one', [App\Http\Controllers\UserController::class, 'step_one']);
Route::post('/step-one', [App\Http\Controllers\UserController::class, 'step_one_store']);
Route::get('/step-two', [App\Http\Controllers\UserController::class, 'step_two'])->name('steptwo');
Route::post('/step-two', [App\Http\Controllers\UserController::class, 'step_two_store']);
Route::get('/dang-nhap', [App\Http\Controllers\UserController::class, 'dang_nhap']);
Route::post('/dang-nhap', [App\Http\Controllers\UserController::class, 'dang_nhap_store']);
Route::get('/dang-ky', [App\Http\Controllers\UserController::class, 'dang_ky']);
Route::post('/dang-ky', [App\Http\Controllers\UserController::class, 'dang_ky_store']);
Route::get('/dang-xuat', [App\Http\Controllers\UserController::class, 'dang_xuat']);
Route::get('/hoso', [App\Http\Controllers\UserController::class, 'hoso']);
Route::post('/hoso-update', [App\Http\Controllers\UserController::class, 'hoso_update']);
Route::post('/hoso-password-update', [App\Http\Controllers\UserController::class, 'hoso_password_update']);
Route::get('/menu', [App\Http\Controllers\UserController::class, 'menu']);
Route::get('/menu/{sp_id}', [App\Http\Controllers\UserController::class, 'menudetails']);
Route::get('/about-us', [App\Http\Controllers\UserController::class, 'about_us']);
Route::get('/contact', [App\Http\Controllers\UserController::class, 'contact']);
Route::get('/list-reservation', [App\Http\Controllers\UserController::class, 'list_reservation']);
Route::get('/list-reservation/list', [App\Http\Controllers\UserController::class, 'get_list_reservation'])->name('list_reservation1');
Route::get('/edit-reservation-customer/{reservation_id}', [App\Http\Controllers\UserController::class, 'edit_reservation_customer'])->name('edit_reservation_customer');
Route::post('/update-reservation-user/{reservation_id}', [App\Http\Controllers\UserController::class, 'update_reservation_user']);
Route::get('/delete-reservation-customer/{reservation_id}', [App\Http\Controllers\UserController::class, 'delete_reservation_customer'])->name('delete_reservation_customer');
Route::get('/forget-password', [App\Http\Controllers\UserController::class, 'forget_password']);
Route::post('/forget-password', [App\Http\Controllers\UserController::class, 'post_forget_password']);
Route::get('/get-password/{customer}/{token}', [App\Http\Controllers\UserController::class, 'get_password'])->name('customer.getpass');
Route::post('/get-password/{customer}/{token}', [App\Http\Controllers\UserController::class, 'post_get_password']);
Route::get('/notify-error-comment', [App\Http\Controllers\UserController::class, 'notify_error_comment']);
Route::post('/search-customer', [App\Http\Controllers\UserController::class, 'search_customer']);
Route::get('/post-customer', [App\Http\Controllers\UserController::class, 'post']);
Route::get('/details-post/{post_id}', [App\Http\Controllers\UserController::class, 'details_post']);






//Authentication roles
Route::get('/register-auth', [App\Http\Controllers\AuthController::class, 'register_auth']);
Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);
Route::get('/login-auth', [App\Http\Controllers\AuthController::class, 'login_auth']);
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);
Route::get('/logout-auth', [App\Http\Controllers\AuthController::class, 'logout_auth']);
Route::get('/fogret-auth', [App\Http\Controllers\AuthController::class, 'get_forget_auth']);
Route::post('/fogret-auth', [App\Http\Controllers\AuthController::class, 'post_forget_auth']);
Route::get('/get-password-auth/{auth}/{token}', [App\Http\Controllers\AuthController::class, 'get_password_auth'])->name('auth.getpass');
Route::post('/get-password-auth/{auth}/{token}', [App\Http\Controllers\AuthController::class, 'post_password_auth']);


//Admin
Route::group(['middleware' => 'auth.role'], function () {
    //Category
    Route::resource('/category', CategoryController::class);
    Route::get('/all-category/list', [App\Http\Controllers\CategoryController::class, 'get_all_category'])->name('list_category');
    Route::get('/active-category/{category_id}', [App\Http\Controllers\CategoryController::class, 'active_category'])->name('active_category');
    Route::get('/unactive-category/{category_id}', [App\Http\Controllers\CategoryController::class, 'unactive_category'])->name('unactive_category');
    //Product
    Route::resource('/product', ProductController::class);
    Route::get('/all-product/list', [App\Http\Controllers\ProductController::class, 'get_all_product'])->name('list_product');
    Route::get('/unactive-product/{product_id}', [App\Http\Controllers\ProductController::class, 'unactive_product'])->name('unactive_product');
    Route::get('/active-product/{product_id}', [App\Http\Controllers\ProductController::class, 'active_product'])->name('active_product');
    Route::get('/add-gallery/{product_id}', [App\Http\Controllers\GalleryController::class, 'add_gallery'])->name('add_gallery');
    Route::post('/select-gallery', [App\Http\Controllers\GalleryController::class, 'select_gallery']);
    Route::post('/insert-gallery/{pro_id}', [App\Http\Controllers\GalleryController::class, 'insert_gallery']);
    Route::post('/update-gallery-name', [App\Http\Controllers\GalleryController::class, 'update_gallery_name']);
    Route::post('/delete-gallery', [App\Http\Controllers\GalleryController::class, 'delete_gallery']);
    //Table
    Route::resource('/table', TableController::class);
    Route::get('/all-table/list', [App\Http\Controllers\TableController::class, 'get_all_table'])->name('list_table');
    //Customer
    Route::resource('/customer', CustomerController::class);
    Route::get('/all-customer/list', [App\Http\Controllers\CustomerController::class, 'get_all_customer'])->name('list_customer');
    Route::get('/lock-customer/{customer_id}', [App\Http\Controllers\CustomerController::class, 'lock_customer'])->name('lock_customer');
    Route::get('/unlock-customer/{customer_id}', [App\Http\Controllers\CustomerController::class, 'unlock_customer'])->name('unlock_customer');

    //Reservation
    Route::get('/add-reservation', [App\Http\Controllers\ReservationController::class, 'add_reservation']);
    Route::post('/save-reservation', [App\Http\Controllers\ReservationController::class, 'save_reservation']);
    Route::get('/all-reservation', [App\Http\Controllers\ReservationController::class, 'all_reservation']);
    Route::get('/edit-reservation/{reservation_id}', [App\Http\Controllers\ReservationController::class, 'edit_reservation'])->name('edit_reservation');
    Route::get('/delete-reservation/{reservation_id}', [App\Http\Controllers\ReservationController::class, 'delete_reservation'])->name('delete_reservation');
    Route::post('/update-reservation-admin/{reservation_id}', [App\Http\Controllers\ReservationController::class, 'update_reservation_admin']);
    Route::get('/all-reservation/list', [App\Http\Controllers\ReservationController::class, 'get_all_reservation'])->name('list_reservation');
    Route::get('/details-reservation/{reservation_id}', [App\Http\Controllers\ReservationController::class, 'details_reservation'])->name('details_reservation');
    Route::post('/approve-reservation/{reservation_id}', [App\Http\Controllers\ReservationController::class, 'approve_reservation']);
    Route::post('/customer-checkout-yes/{reservation_id}', [App\Http\Controllers\ReservationController::class, 'customer_checkout_yes']);
    Route::post('/customer-checkout-no/{reservation_id}', [App\Http\Controllers\ReservationController::class, 'customer_checkout_no']);
    Route::get('/getevent', [App\Http\Controllers\ReservationController::class, 'calendar_reservation'])->name('getevent');

    //Statictical
    Route::get('/statictical', [App\Http\Controllers\StaticticalController::class, 'statictical']);
    Route::get('/statictical-data', [App\Http\Controllers\StaticticalController::class, 'statictical_data']);
    Route::post('/filter-by-date', [App\Http\Controllers\StaticticalController::class, 'filter_by_date']);
    Route::post('/statictical-filter', [App\Http\Controllers\StaticticalController::class, 'statictical_filter']);
    Route::post('/days-order', [App\Http\Controllers\StaticticalController::class, 'days_order']);
    Route::get('/statistical-year', [App\Http\Controllers\StaticticalController::class, 'statistical_year']);
    Route::post('/year-filter', [App\Http\Controllers\StaticticalController::class, 'year_filter']);
    Route::post('/details-statistical-month', [App\Http\Controllers\StaticticalController::class, 'details_statistical_month']);
    Route::get('/details-staff-revenue/{admin_id}', [App\Http\Controllers\StaticticalController::class, 'details_staff_revenue']);
    Route::get('/details-customer-revenue/{khachhang_id}', [App\Http\Controllers\StaticticalController::class, 'details_customer_revenue']);
    Route::get('/details-reservation-revenue/{khachhang_id}', [App\Http\Controllers\StaticticalController::class, 'details_reservation_revenue']);
    Route::get('/details-ingredient-remaining-statistical', [App\Http\Controllers\StaticticalController::class, 'details_ingredient_remaining_statistical']);
    Route::get('/details-ingredient-statistical', [App\Http\Controllers\StaticticalController::class, 'details_ingredient_statistical']);

    //Email
    Route::get('/config-email', [App\Http\Controllers\EmailController::class, 'config_email']);
    Route::post('/save-config-email/{mail_id}', [App\Http\Controllers\EmailController::class, 'save_config_email']);
    //Receipt
    Route::get('/all-receipt', [App\Http\Controllers\ReceiptController::class, 'all_receipt']);
    Route::get('/details-receipt/{receipt_id}', [App\Http\Controllers\ReceiptController::class, 'details_receipt'])->name('details_receipt');
    Route::get('/all-receipt/list', [App\Http\Controllers\ReceiptController::class, 'get_all_receipt'])->name('list_receipt');
    Route::get('/print-receipt/{receipt_id}', [App\Http\Controllers\ReceiptController::class, 'print_receipt'])->name('print_receipt');
    Route::get('/input-receipt', [App\Http\Controllers\ReceiptController::class, 'get_input_receipt']);
    Route::post('/input-receipt', [App\Http\Controllers\ReceiptController::class, 'post_input_receipt']);
    //Supplier
    Route::resource('/supplier', SupplierController::class);
    Route::get('/all-supplier/list', [App\Http\Controllers\SupplierController::class, 'get_supplier'])->name('list_supplier');
    Route::post('/save-supplier1', [App\Http\Controllers\SupplierController::class, 'save_supplier1']);

    //Comment
    Route::get('/all-comment/list', [App\Http\Controllers\CommentController::class, 'get_comment'])->name('list_comment');
    Route::get('/all-comment', [App\Http\Controllers\CommentController::class, 'all_comment']);
    Route::get('/delete-comment/{comment_id}', [App\Http\Controllers\CommentController::class, 'delete_comment'])->name('delete_comment');
    Route::post('/load-comment', [App\Http\Controllers\CommentController::class, 'load_comment']);
    Route::post('/send-comment', [App\Http\Controllers\CommentController::class, 'send_comment']);
    Route::get('/active-comment/{comment_id}', [App\Http\Controllers\CommentController::class, 'active_comment'])->name('active_comment');
    Route::get('/unactive-comment/{comment_id}', [App\Http\Controllers\CommentController::class, 'unactive_comment'])->name('unactive_comment');
    //Staff
    Route::resource('/staff', StaffController::class);
    Route::get('/all-staff/list', [App\Http\Controllers\StaffController::class, 'get_all_staff'])->name('list_staff');
    Route::get('/lock-staff/{admin_id}', [App\Http\Controllers\StaffController::class, 'lock_staff'])->name('lock_staff');
    Route::get('/unlock-staff/{admin_id}', [App\Http\Controllers\StaffController::class, 'unlock_staff'])->name('unlock_staff');
    Route::post('/assign-roles1', [App\Http\Controllers\StaffController::class, 'assign_roles1']);

    //Ingredient
    Route::resource('/ingredient', IngredientController::class);
    Route::get('/all-ingredient/list', [App\Http\Controllers\IngredientController::class, 'get_ingredient'])->name('list_ingredient');
    Route::get('/check-ingredient', [App\Http\Controllers\IngredientController::class, 'check_ingredient']);
    Route::post('/check-update-ingredient', [App\Http\Controllers\IngredientController::class, 'check_update_ingredient']);
    Route::post('/save-ingredient1', [App\Http\Controllers\IngredientController::class, 'save_ingredient1']);
    Route::get('/active-ingredient/{ingredient}', [App\Http\Controllers\IngredientController::class, 'active_ingredient'])->name('active_ingredient');
    Route::get('/unactive-ingredient/{ingredient}', [App\Http\Controllers\IngredientController::class, 'unactive_ingredient'])->name('unactive_ingredient');
    Route::get('/all-input-receipt', [App\Http\Controllers\IngredientController::class, 'all_input_receipt']);
    Route::get('/all-input-receipt/list', [App\Http\Controllers\IngredientController::class, 'get_all_input_receipt'])->name('list_all_input_receipt');

    //Quantitative
    Route::resource('/quantitative', QuantitativeController::class);
    Route::get('/all-quantitative/list', [App\Http\Controllers\QuantitativeController::class, 'get_quantitative'])->name('list_quantitative');
    Route::get('/active-quantitative/{quantitative_id}', [App\Http\Controllers\QuantitativeController::class, 'active_quantitative'])->name('active_quantitative');
    Route::get('/unactive-quantitative/{quantitative_id}', [App\Http\Controllers\QuantitativeController::class, 'unactive_quantitative'])->name('unactive_quantitative');

    //Coupon
    Route::resource('/coupon', CouponController::class);
    Route::get('/all-coupon/list', [App\Http\Controllers\CouponController::class, 'get_coupon'])->name('list_coupon');
    Route::get('/check-coupon/{coupon_id}', [App\Http\Controllers\CouponController::class, 'check_coupon']);
    Route::get('/delete-coupon-checkout', [App\Http\Controllers\CouponController::class, 'delete_coupon_checkout']);

    //Post
    Route::resource('/post', PostController::class);
    Route::get('/all-post/list', [App\Http\Controllers\PostController::class, 'get_all_post'])->name('list_post');
    Route::get('/active-post/{post_id}', [App\Http\Controllers\PostController::class, 'active_post'])->name('active_post');
    Route::get('/unactive-post/{post_id}', [App\Http\Controllers\PostController::class, 'unactive_post'])->name('unactive_post');
});



//Staff
Route::group(['middleware' => 'auth.roles'], function () {

    //Backend
    Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'showdashboard']);
    Route::get('/profile', [App\Http\Controllers\AdminController::class, 'profile']);
    Route::post('/profile-update', [App\Http\Controllers\AdminController::class, 'profile_update']);
    Route::post('/profile-password-update', [App\Http\Controllers\AdminController::class, 'profile_password_update']);
    Route::post('/recover-pass', [App\Http\Controllers\AdminController::class, 'recover_pass']);
    Route::get('/password/reset', [App\Http\Controllers\AdminController::class, 'resetPassword']);
    //Pos
    Route::get('/pos', [App\Http\Controllers\PosController::class, 'pos']);
    Route::get('/add-to-cart/{id}', [App\Http\Controllers\PosController::class, 'addToCart'])->name('addToCart');
    Route::get('/add-to-cart-plus/{id}', [App\Http\Controllers\PosController::class, 'addToCartPlus'])->name('addToCartPlus');
    Route::get('/add-to-cart-minus/{id}', [App\Http\Controllers\PosController::class, 'addToCartMinus'])->name('addToCartMinus');
    Route::get('/delete-cart', [App\Http\Controllers\PosController::class, 'deleteCart'])->name('deleteCart');
    Route::post('/add-customer-pos', [App\Http\Controllers\PosController::class, 'add_customer_pos']);
    Route::get('load-cate/{id}', [App\Http\Controllers\PosController::class, 'loadCate'])->name('loadCate');
    Route::get('/load-cate-again/{id}', [App\Http\Controllers\PosController::class, 'loadCate1'])->name('loadCate1');
    Route::post('/search', [App\Http\Controllers\PosController::class, 'search']);
    Route::post('/search1', [App\Http\Controllers\PosController::class, 'search1']);
    Route::get('/exit-order', [App\Http\Controllers\PosController::class, 'exit_order']);


    //Pos1
    Route::post('/save-order', [App\Http\Controllers\CartController::class, 'save_order']);
    Route::get('/add-order-again/{order_id}', [App\Http\Controllers\CartController::class, 'add_order_again']);
    Route::post('/details-order-dashboard', [App\Http\Controllers\CartController::class, 'details_order_dashboard']);
    Route::get('/order-complete/{order_id}', [App\Http\Controllers\CartController::class, 'order_complete']);
    Route::get('/order-complete/{order_id}', [App\Http\Controllers\CartController::class, 'order_complete']);
    Route::get('/add-to-cart-again/{id}', [App\Http\Controllers\CartController::class, 'addToCartagain'])->name('addToCartgain');
    Route::get('/add-to-cart-again-plus/{id}', [App\Http\Controllers\CartController::class, 'addTocartagainPlus'])->name('addTocartagainPlus');
    Route::get('/add-to-cart-again-minus/{id}', [App\Http\Controllers\CartController::class, 'addToCartagainMinus'])->name('addToCartagainMinus');
    Route::get('/delete-cart-again', [App\Http\Controllers\CartController::class, 'deleteCartagain'])->name('deleteCartagain');
    Route::post('/save-order-again', [App\Http\Controllers\CartController::class, 'save_order_again']);
    Route::post('/confirm-order/{order_id}', [App\Http\Controllers\CartController::class, 'confirm_order']);
    Route::get('/unaccept-order/{order_id}', [App\Http\Controllers\CartController::class, 'unaccept_order']);
    Route::post('/change-table/{table_id}', [App\Http\Controllers\CartController::class, 'change_table']);
    Route::get('/payment-order/{order_id}', [App\Http\Controllers\CheckoutController::class, 'payment_order']);
    Route::post('/payment-order-store', [App\Http\Controllers\CheckoutController::class, 'payment_order_store']);
    Route::get('/print-invoice/{order_id}', [App\Http\Controllers\CheckoutController::class, 'print_invoice']);
    Route::get('/kqthanhtoanmomo', [App\Http\Controllers\CheckoutController::class, 'kqthanhtoanmomo']);
    Route::get('/kqthanhtoanvnpay', [App\Http\Controllers\CheckoutController::class, 'kqthanhtoanvnpay']);


    //Order
    Route::get('/all-order', [App\Http\Controllers\OrderController::class, 'all_order']);
    Route::get('/all-order/list', [App\Http\Controllers\OrderController::class, 'get_all_order'])->name('list_order');
    Route::get('/details-order/{order_id}', [App\Http\Controllers\OrderController::class, 'details_ordtomer'])->name('details_order');
    Route::get('/delete-ordtomer/{order_id}', [App\Http\Controllers\OrderController::class, 'delete_ordtomer'])->name('delete_order');
    Route::post('/filter', [App\Http\Controllers\OrderController::class, 'filter']);
    Route::get('/print-order/{order_id}', [App\Http\Controllers\OrderController::class, 'print_order'])->name('print_order');

    //Shift
    Route::get('/all-shift', [App\Http\Controllers\ShiftController::class, 'all_shift']);
    Route::get('/all-shift/list', [App\Http\Controllers\ShiftController::class, 'get_all_shift'])->name('list_shift');
    Route::get('/notice-shift', [App\Http\Controllers\ShiftController::class, 'notice_shift']);
    Route::get('/edit-shift/{shift_id}', [App\Http\Controllers\ShiftController::class, 'edit_shift']);
    Route::post('/edit-shift/{shift_id}', [App\Http\Controllers\ShiftController::class, 'update_shift']);
    Route::post('/on-shift', [App\Http\Controllers\ShiftController::class, 'on_shift']);
    Route::post('/off-shift/{shift_id}', [App\Http\Controllers\ShiftController::class, 'off_shift']);
    Route::get('/details-shift/{shift_id}', [App\Http\Controllers\ShiftController::class, 'details_shift'])->name('details_shift');
    Route::get('/delete-shift/{shift_id}', [App\Http\Controllers\ShiftController::class, 'delete_shift'])->name('delete_shift');

    //Chat
    Route::get('/chat', [App\Http\Controllers\ChatController::class, 'chat']);
    Route::get('/message/{id}', [App\Http\Controllers\ChatController::class, 'getMessage'])->name('message');
    Route::post('message', [App\Http\Controllers\ChatController::class, 'sendMessage']);
});
