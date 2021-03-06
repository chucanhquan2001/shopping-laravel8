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

// nh???ng route ??? ngo??i client c???n ????ng nh???p
Route::group(['middleware' => 'auth-check-client'], function () {
    // logout 
    Route::get('/dang-xuat', [AuthController::class, 'logout'])->name('logout.client');
    Route::get('/don-hang', [AuthController::class, 'invoice'])->name('invoice.client');
    Route::get('/don-hang/{invoice_id}', [AuthController::class, 'cancelOrder'])->name('cancelOrder');
});

// route trang ch???
Route::get('/', [HomeController::class, 'index'])->name('home');

// login client
Route::get('/dang-nhap', [AuthController::class, 'loginClient'])->name('login.client')->middleware('guest');
Route::post('/dang-nhap', [AuthController::class, 'loginClientPost'])->name('login.client')->middleware('guest');

//????ng k?? t??i kho???n
Route::get('/dang-ki', [AuthController::class, 'registerClient'])->name('register.client')->middleware('guest');
Route::post('/dang-ki', [AuthController::class, 'registerClientPost'])->name('register.client')->middleware('guest');

// ???????ng d???n t??? danh m???c con
Route::get('/danh-muc/{slug}', [CategoryOutsideCustomerController::class, 'categoryParent'])->name('category.parent');

// ???????ng d???n t??? danh m???c cha
Route::get('/danh-muc-con/{slug}', [CategoryOutsideCustomerController::class, 'categoryChildren'])->name('category.children');

// ???????ng d???n ?????n trang chi ti???t s???n ph???m
Route::get('/san-pham/{slug}', [ProductDetailOutsideCustomerController::class, 'index'])->name('client.product.detail');

// ???????ng d???n ?????i thu???c t??nh bi???n th??? cho s???n ph???m
Route::get('/change-product-variant', [ProductDetailOutsideCustomerController::class, 'changProductVariant'])->name('change.product.variant');

// ???????ng d???n post comment c???a kh??ch h??ng
Route::post('/add-review', [ProductDetailOutsideCustomerController::class, 'storeReview'])->name('add.review');

// ???????ng d???n post tr??? l???i b??nh lu???n c???a kh??ch H??ng
Route::post('/add-reply', [ProductDetailOutsideCustomerController::class, 'storeReply'])->name('add.reply');

// ???????ng d???n th??m gi??? h??ng
Route::post('/add-cart', [CartController::class, 'addCart'])->name('add.cart');

// ???????ng d???n x??a t???t c??? gi??? H??ng
Route::get('/delete-cart', [CartController::class, 'deleteCart'])->name('delete.cart');

// ???????ng d???n x??a 1 item trong gi??? H??ng
Route::get('/delete-item-cart', [CartController::class, 'deleteItemCart'])->name('delete.item.cart');

// ???????ng d???n hi???n th??? th??ng tin gi??? h??ng
Route::get('/gio-hang', [CartController::class, 'showCart'])->name('show.cart');

// ???????ng d???n update gi??? h??ng
Route::get('/cap-nhap/gio-hang', [CartController::class, 'updateCart'])->name('update.cart');

// ???????ng d???n show trang thanh to??n
Route::get('/thanh-toan', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/thanh-toan', [CheckoutController::class, 'store'])->name('checkout.index');

// ???????ng d???n th??ng b??o thanh to??n th??nh c??ng
Route::get('/dat-hang-thanh-cong', [CheckoutController::class, 'orderSuccess'])->name('order.success.index');




// login qu???n tr???
Route::get('admin/login', [AdminController::class, 'login'])->name('login-admin')->middleware('guest');
Route::post('admin/login', [AdminController::class, 'loginPost'])->name('login-admin')->middleware('guest');



// file manager
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});