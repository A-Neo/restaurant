<?php

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Shop\AboutController;
use App\Http\Controllers\Shop\AddressController;
use App\Http\Controllers\Shop\BanquetController;
use App\Http\Controllers\Shop\BookingController;
use App\Http\Controllers\Shop\CallbackController;
use App\Http\Controllers\Shop\CartController;
use App\Http\Controllers\Shop\ChildrenController;
use App\Http\Controllers\Shop\ContactController;
use App\Http\Controllers\Shop\OrderController;
use App\Http\Controllers\Shop\PageController;
use App\Http\Controllers\Shop\SmsController;
use App\Http\Controllers\Shop\StreetController;
use App\Http\Controllers\AdminController;
use App\View\Components\Beverage;
use App\View\Components\Cart;
use App\View\Components\Delivery;
use App\View\Components\Food;
use App\View\Components\Product;
use App\View\Components\Street;
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
Route::get('locale/{locale}', [\App\Http\Controllers\Shop\MainController::class, 'changeLocale'])->name('locale');

Route::middleware(['set_locale'])->group(function () {
    Route::get('/', [\App\Http\Controllers\Shop\MainController::class, 'index'])->name('home');
    Route::get('/food/{slug}', [\App\Http\Controllers\Shop\CategoryController::class, 'food'])->name('food');
    Route::post('/food/{slug}', [Food::class, 'update'])->name('food.update');
    Route::get('/beverage/{slug}', [\App\Http\Controllers\Shop\CategoryController::class, 'beverage'])->name('beverage');
    Route::post('/beverage/{slug}', [Beverage::class, 'update'])->name('beverage.update');
    Route::get('/delivery/{slug?}', [\App\Http\Controllers\Shop\DeliveryController::class, 'index'])->name('delivery');
    Route::post('/delivery', [\App\Http\Controllers\Shop\DeliveryController::class, 'update'])->name('delivery.update');
    Route::get('/delivery/products', [\App\Http\Controllers\Shop\DeliveryController::class, 'getPaginatedProducts'])->name('delivery.products');
    Route::post('/product', [Product::class, 'update'])->name('product.update');
    Route::get('/news/{slug?}', [\App\Http\Controllers\Shop\ArticleController::class, 'index'])->name('articles');
    Route::get('/article/{slug?}', [\App\Http\Controllers\Shop\ArticleController::class, 'article'])->name('article');
    Route::post('/callback/{id}', [CallbackController::class, 'index'])->name('callback');
    Route::get('/booking', [BookingController::class, 'index'])->name('booking');
//    Route::get('/banquet', [BanquetController::class, 'index'])->name('banquet');
    Route::get('/banquet/{slug}', [BanquetController::class, 'show'])->name('banquet');
    Route::get('/children', [ChildrenController::class, 'index'])->name('children');
    Route::get('/testing', [ChildrenController::class, 'testing'])->name('testing');
    Route::get('/about', [AboutController::class, 'index'])->name('about');
    Route::get('/contact', [ContactController::class, 'index'])->name('contact');
    Route::post('/addCart', [CartController::class, 'addCart'])->name('addCart');
    Route::post('/countCart', [CartController::class, 'countCart'])->name('countCart');
    Route::post('/plusCart', [CartController::class, 'plusProduct'])->name('plusCart');
    Route::post('/minusCart', [CartController::class, 'minusProduct'])->name('minusCart');
    Route::post('/deleteCart', [CartController::class, 'cartDelete'])->name('deleteCart');
    Route::post('/cart', [Cart::class, 'update'])->name('cart.update');
    Route::get('/order', [OrderController::class, 'index'])->name('order');
    Route::post('/street', [StreetController::class, 'street'])->name('street');
    Route::post('/streets', [Street::class, 'update'])->name('street.update');
    Route::post('/createOrder', [OrderController::class, 'createOrder'])->name('createOrder');
    Route::get('/policy', [PageController::class, 'policy'])->name('policy');
    Route::get('/personal', [PageController::class, 'personal'])->name('personal');
    Route::get('/offers', [PageController::class, 'offers'])->name('offers');
    // SmsController
    Route::post('/sms', [SmsController::class, 'index'])->name('sms');
    Route::post('/code', [SmsController::class, 'code'])->name('code');
//    Route::post('/send-phone', [SmsController::class, 'sendPhone'])->name('send.phone');
//    Route::post('/verify-code', [SmsController::class, 'verifyCode'])->name('verify.code');
    // End SmsController
    Route::get('/{page}/success', [CallbackController::class, 'success'])->where('page', '.*')->name('page.success');
});

Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('/admin/auth', [AdminController::class, 'auth'])->name('admin.auth');
Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout')->middleware('auth');

Route::match(['GET', 'POST'], '/payments/callback', [PaymentController::class, 'callback'])->name('payment.callback')->middleware('throttle:5,1');
Route::post('/payments/create', [PaymentController::class, 'create'])->name('payment.create');

Route::post('/save-address', [AddressController::class, 'store'])->middleware('auth')->name('address.save');

Route::get('/banquet', function () {
    return redirect('/banquet/banquet');
});

Route::get('/testing', [CartController::class, 'testing'])->name('test');
//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
