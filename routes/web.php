<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CrudUserController;
use App\Http\Controllers\GoogleController;



use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;




use App\Http\Controllers\CartController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\CheckoutCartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\NoiDungController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\GopYController;



use App\Http\Controllers\AdminController;
use App\Http\Controllers\NguoiDungController;
use App\Http\Controllers\MaGiamGiaController;
use App\Http\Controllers\DonHangController;
use App\Models\DonHang;
use App\Models\NhanVien;


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

Route::get('dashboard', [CrudUserController::class, 'dashboard'])->name('dashboard');

Route::get('login', [CrudUserController::class, 'login'])->name('login');
Route::post('login', [CrudUserController::class, 'authUser'])->name('user.authUser');

Route::get('create', [CrudUserController::class, 'createUser'])->name('user.createUser');
Route::post('create', [CrudUserController::class, 'postUser'])->name('user.postUser');

Route::get('read', [CrudUserController::class, 'readUser'])->name('user.readUser');

Route::get('delete', [CrudUserController::class, 'deleteUser'])->name('user.deleteUser');

Route::get('update', [CrudUserController::class, 'updateUser'])->name('user.updateUser');
Route::post('update', [CrudUserController::class, 'postUpdateUser'])->name('user.postUpdateUser');

Route::get('list', [CrudUserController::class, 'listUser'])->name('user.list');

Route::get('signout', [CrudUserController::class, 'signOut'])->name('signout');


Route::get('login/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('login/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::get('product', [ProductController::class, 'product'])->name('product');

Route::get('forgetpw', [CrudUserController::class, 'forgetpw'])->name('forgetpw');






Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotForm'])->name('password.forgot');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetCode'])->name('password.send-code');

Route::get('/verify-code', [ForgotPasswordController::class, 'showVerifyForm'])->name('password.verify-form');
Route::post('/verify-code', [ForgotPasswordController::class, 'verifyCode'])->name('password.verify');

Route::get('/reset-password', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset-form');
Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('password.reset');

Route::get('/thong-tin-ca-nhan', [CrudUserController::class, 'thongTinCaNhan'])->name('user.info')->middleware('auth');

Route::get('/doi-mat-khau', [CrudUserController::class, 'formDoiMatKhau'])->name('change.password')->middleware('auth');
Route::post('/doi-mat-khau', [CrudUserController::class, 'doiMatKhau'])->name('change.password.post')->middleware('auth');

Route::get('/products/category/{id}', [ProductController::class, 'product'])->name('products.category');


Route::get('search', [CrudUserController::class, 'search'])->name('product.search');


Route::get('item/{id}', [CrudUserController::class, 'showProductDetail'])->name('product.detail');





Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
Route::get('/product/index', [ProductController::class, 'index'])->name('admin.category_product');
Route::get('/products/create', [ProductController::class, 'create'])->name('product.create');
Route::post('/products', [ProductController::class, 'store'])->name('product.store');



Route::get('product/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
Route::put('product/{id}', [ProductController::class, 'update'])->name('product.update');

Route::get('/admin/products', [ProductController::class, 'index'])->name('product.index');

//Danhmuc
Route::get('/admin/categories', [CategoryController::class, 'index'])->name('category.index');
Route::get('/admin/categories/create', [CategoryController::class, 'create'])->name('category.create');
Route::post('/admin/categories', [CategoryController::class, 'store'])->name('category.store');
Route::get('/admin/categories/{category}/edit', [CategoryController::class, 'edit'])->name('category.edit');
Route::put('/admin/categories/{category}', [CategoryController::class, 'update'])->name('category.update');
Route::delete('/admin/categories/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');

Route::get('/admin/index', [ProductController::class, 'crud'])
    ->middleware(['auth', 'nhanvien'])
    ->name('crud.index');


Route::get('/', function () {
    return view('crud_user.login');
});



//cart 
Route::get('/cart', [CartController::class, 'cart'])->name('cart.cart');
Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart/remove/{MaSanPham}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/upadte/{MaGioHang}', [CartController::class, 'updateQuantity'])->name('cart.update');
//checkbox
Route::get('/cart', [CartController::class, 'showCart'])->name('cart.cart');
//cart payment
Route::get('/cart_payment', [CartController::class, 'CartPayment'])->name('cart.cartpayment');
Route::post('/cart/payment', [CartController::class, 'submitPayment'])->name('cart.payment.submit');
//load ma giam gia de chon
Route::get('/coupons', [CartController::class, 'getCoupons'])->name('cart.getCoupons');

//dia chi
Route::get('/provinces', [AddressController::class, 'getProvinces']);
Route::get('/districts/{provinceId}', [AddressController::class, 'getDistricts']);
Route::get('/wards/{districtId}', [AddressController::class, 'getWards']);
//info nguoi dung
Route::get('/checkout/info', [CartController::class, 'infoUser'])->name('cart.info_user');
Route::post('checkout/info', [CartController::class, 'storeInfo'])->name('cart.info_user.store');
//kiem tra thong tin khi dung nhan mua hang trong gio hang
Route::get('/cart/check', [CartController::class, 'checkCart'])->name('cart.check');


Route::get('/cart_result', [CartController::class, 'CartResult'])->name('cart.result_cart');
Route::get('/', function () {
    return view('welcome');
})->name('home');
Route::get('/history_cart', [CartController::class, 'historyCart'])->name('cart.history_cart');
Route::get('/order_detail/{MaDonHang}', [CartController::class, 'order_detail'])->name('cart.order_detail');

//form momo_payment
Route::get('/momo_check', [CartController::class, 'momocheck'])->name('cart.momo_check');
//ma giam gia
Route::get('/coupons', [CartController::class, 'showCoupons'])->name('cart.getCoupons');

// Áp dụng mã giảm giá
Route::get('/apply-coupon/{coupon_code}', [CartController::class, 'applyCoupon'])->name('cart.applyCoupon');

Route::post('/momo_payment', [CheckoutCartController::class, 'momo_payment'])->name('momo_payment');



// danh sách đơn hàng admin 
Route::get('/admin/orders', [OrderController::class, 'index'])
    ->middleware(['auth', 'admin'])
    ->name('admin.orders');

Route::put('/admin/orders/{id}', [OrderController::class, 'update'])->name('admin.orders.update');
Route::get('/admin/orders/{id}', [OrderController::class, 'show'])->name('admin.orders.show');

// banner/thông báo
Route::prefix('admin/noidung')->group(function () {
    Route::get('/', [NoiDungController::class, 'index'])->name('admin.noidung.index');
    Route::get('/create', [NoiDungController::class, 'create'])->name('admin.noidung.create');
    Route::post('/store', [NoiDungController::class, 'store'])->name('admin.noidung.store');
    Route::delete('/admin/noidung/{id}', [NoiDungController::class, 'destroy'])->name('admin.noidung.destroy');
    Route::post('/admin/noidung/{id}/activate', [NoiDungController::class, 'activate'])->name('admin.noidung.activate');

    Route::get('/admin/noidung/{id}/edit', [NoiDungController::class, 'edit'])->name('admin.noidung.edit');
    Route::put('/admin/noidung/{id}', [NoiDungController::class, 'update'])->name('admin.noidung.update');
});

// Chat box: khách hàng
Route::middleware(['auth'])->group(function () {
    Route::get('/chat', [ChatController::class, 'form'])->name('chat.form');
    Route::post('/chat/send', [ChatController::class, 'send'])->name('chat.send');
});

// // Chat box: admin
// Route::middleware(['auth', 'admin'])->group(function () {
//     Route::get('/admin/chat', [ChatController::class, 'admin'])->name('admin.chat.list');
//     Route::get('/admin/chat/{id}', [ChatController::class, 'viewChat'])->name('admin.chat.view');
//     Route::post('/admin/chat/reply', [ChatController::class, 'reply'])->name('admin.chat.reply');
// });

// TẠM BỎ middleware để test
Route::get('/admin/chat', [ChatController::class, 'admin'])->name('admin.chat.list');
Route::get('/admin/chat/{id}', [ChatController::class, 'viewChat'])->name('admin.chat.view');
Route::post('/admin/chat/reply', [ChatController::class, 'reply'])->name('admin.chat.reply');

// Góp ý
Route::middleware(['auth'])->prefix('gopy')->group(function () {
    Route::get('/', [GopYController::class, 'index'])->name('gopy.index');
    Route::get('/create', [GopYController::class, 'create'])->name('gopy.create');
    Route::post('/store', [GopYController::class, 'store'])->name('gopy.store');
    Route::get('/thankyou', [GopYController::class, 'thankYou'])->name('gopy.thankyou');
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('reports', [AdminController::class, 'reports'])->name('admin.reports');
    Route::get('reports-by-date', [AdminController::class, 'getReportsByDate'])->name('admin.reportsByDate');
    // users
    Route::get('/users', [NguoiDungController::class, 'getAllNguoiDung'])->name('users.list');
    Route::get('editUser/{id}', [NguoiDungController::class, 'editUsers'])->name('admin.edit');
    Route::post('editUser', [NguoiDungController::class, 'updateUsers'])->name('admin.updateUser');
    Route::delete('Users/{id}', [NguoiDungController::class, 'deleteUsers'])->name('admin.deleteUser');
    Route::get('createUsers', [NguoiDungController::class, 'createUsers'])->name('admin.createUsers');
    Route::post('createUsers', [NguoiDungController::class, 'postUsers'])->name('admin.postUsers');

    // discounts
    Route::get('discounts', [MaGiamGiaController::class, 'showDiscounts'])->name('admin.discounts');
    Route::delete('discounts/{id}', [MaGiamGiaController::class, 'deleteDiscounts'])->name('admin.deleteDiscounts');
    Route::get('createDiscounts', [MaGiamGiaController::class, 'createDiscounts'])->name('admin.createDiscounts');
    Route::post('createDiscounts', [MaGiamGiaController::class, 'postDiscounts'])->name('admin.postDiscounts');
    Route::get('editDiscounts/{id}', [MaGiamGiaController::class, 'editDiscounts'])->name('admin.editDiscounts');
    Route::post('editDiscounts', [MaGiamGiaController::class, 'updateDiscounts'])->name('admin.updateDiscounts');

    // invoices
    Route::get('invoices', [DonHangController::class, 'showInvoices'])->name('admin.invoices');
    Route::delete('invoices/{id}', [DonHangController::class, 'deleteInvoices'])->name('admin.deleteInvoices');
    Route::get('detailInvoices', [DonHangController::class, 'detailInvoices'])->name('admin.detailInvoices');
    Route::get('search', [AdminController::class, 'search'])->name('admin.search');
});
