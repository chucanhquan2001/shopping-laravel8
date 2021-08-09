<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\PostCategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VariantController;
use App\Http\Controllers\VariantValueController;
use App\Http\Controllers\ProductVariantController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\InvoiceDetailController;
use App\Http\Controllers\Clients\HomeController;
use App\Http\Controllers\Clients\CategoryOutsideCustomerController;
use App\Http\Controllers\Clients\ProductDetailOutsideCustomerController;
use App\Http\Controllers\Clients\AuthController;
use App\Http\Controllers\Clients\CartController;
use App\Http\Controllers\Clients\CheckoutController;

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

Route::group(['prefix' => 'admin', 'middleware' => ['can:admin-access', 'auth']], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    // logout 
    Route::get('/logout', [AdminController::class, 'logout'])->name('logout-admin');

    Route::get('product-variant/create/{product_id}', [ProductVariantController::class, 'create'])->name('product-variant.create');
    Route::get('product-variant/{product_id}', [ProductVariantController::class, 'index'])->name('product-variant.index');
    Route::resource('product-variant', ProductVariantController::class)->except('index', 'create');

    Route::resource('category', CategoryController::class);
    Route::resource('menu', MenuController::class);
    Route::resource('slider', SliderController::class);
    Route::resource('setting', SettingController::class);
    Route::resource('post-category', PostCategoryController::class);
    Route::resource('post', PostController::class);
    Route::resource('product', ProductController::class);
    Route::resource('user', UserController::class);
    Route::resource('variant', VariantController::class);
    Route::resource('variant-value', VariantValueController::class);
    Route::resource('role', RoleController::class);
    Route::resource('permission', PermissionController::class);
    Route::resource('review', ReviewController::class);
    Route::get('reply/{review_id}', [ReplyController::class, 'index'])->name('reply.index');
    Route::resource('reply', ReplyController::class)->except('index');
    Route::get('invoice', [InvoiceController::class, 'index'])->name('invoice.index')->middleware('can:invoice-list');
    Route::post('invoice/update/{invoice_id}', [InvoiceController::class, 'update'])->name('invoice.update')->middleware('can:invoice-edit');
    Route::get('invoice/{invoice_id}', [InvoiceController::class, 'invoiceDetail'])->name('invoice.detail')->middleware('can:invoice-list');
});

// những route ở ngoài client cần đăng nhập
Route::group(['middleware' => 'auth-check-client'], function () {
    // logout 
    Route::get('/dang-xuat', [AuthController::class, 'logout'])->name('logout.client');
    Route::get('/don-hang', [AuthController::class, 'invoice'])->name('invoice.client');
    Route::get('/don-hang/{invoice_id}', [AuthController::class, 'cancelOrder'])->name('cancelOrder');
});

// route trang chủ
Route::get('/', [HomeController::class, 'index'])->name('home');

// login client
Route::get('/dang-nhap', [AuthController::class, 'loginClient'])->name('login.client')->middleware('guest');
Route::post('/dang-nhap', [AuthController::class, 'loginClientPost'])->name('login.client')->middleware('guest');

//đăng kí tài khoản
Route::get('/dang-ki', [AuthController::class, 'registerClient'])->name('register.client')->middleware('guest');
Route::post('/dang-ki', [AuthController::class, 'registerClientPost'])->name('register.client')->middleware('guest');

// đường dẫn từ danh mục con
Route::get('/danh-muc/{slug}', [CategoryOutsideCustomerController::class, 'categoryParent'])->name('category.parent');

// đường dẫn từ danh mục cha
Route::get('/danh-muc-con/{slug}', [CategoryOutsideCustomerController::class, 'categoryChildren'])->name('category.children');

// đường dẫn đến trang chi tiết sản phẩm
Route::get('/san-pham/{slug}', [ProductDetailOutsideCustomerController::class, 'index'])->name('client.product.detail');

// đường dẫn đổi thuộc tính biến thể cho sản phẩm
Route::get('/change-product-variant', [ProductDetailOutsideCustomerController::class, 'changProductVariant'])->name('change.product.variant');

// đường dẫn post comment của khách hàng
Route::post('/add-review', [ProductDetailOutsideCustomerController::class, 'storeReview'])->name('add.review');

// đường dẫn post trả lời bình luận của khách Hàng
Route::post('/add-reply', [ProductDetailOutsideCustomerController::class, 'storeReply'])->name('add.reply');

// đường dẫn thêm giỏ hàng
Route::post('/add-cart', [CartController::class, 'addCart'])->name('add.cart');

// đường dẫn xóa tất cả giỏ Hàng
Route::get('/delete-cart', [CartController::class, 'deleteCart'])->name('delete.cart');

// đường dẫn xóa 1 item trong giỏ Hàng
Route::get('/delete-item-cart', [CartController::class, 'deleteItemCart'])->name('delete.item.cart');

// đường dẫn hiển thị thông tin giỏ hàng
Route::get('/gio-hang', [CartController::class, 'showCart'])->name('show.cart');

// đường dẫn update giỏ hàng
Route::get('/cap-nhap/gio-hang', [CartController::class, 'updateCart'])->name('update.cart');

// đường dẫn show trang thanh toán
Route::get('/thanh-toan', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/thanh-toan', [CheckoutController::class, 'store'])->name('checkout.index');

// đường dẫn thông báo thanh toán thành công
Route::get('/dat-hang-thanh-cong', [CheckoutController::class, 'orderSuccess'])->name('order.success.index');




// login quản trị
Route::get('admin/login', [AdminController::class, 'login'])->name('login-admin')->middleware('guest');
Route::post('admin/login', [AdminController::class, 'loginPost'])->name('login-admin')->middleware('guest');



// file manager
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});