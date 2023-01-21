<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsNotLoggedIn;
use App\Models\Order;
use App\Models\OrderInfo;
use App\Models\Price;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'sendMessage'])->name('sendMessage');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginAction'])->name('loginAction');
Route::get('/register', [AuthController::class, 'registration'])->name('register');
Route::post('/register', [AuthController::class, 'registrationAction'])->name('registerAction');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::get('/cartdetails', [CartController::class, 'productsInCart'])->name('cartDetails');
Route::resource('products', ProductsController::class);

//USER ROUTES
Route::middleware(IsNotLoggedIn::class)->group(function (){
    Route::get('/checkout', [OrderController::class, 'index'])->name('checkout');
    Route::post('/checkout', [OrderController::class, 'makeOrder'])->name('makeOrder');
    Route::get('/ordered', [OrderController::class, 'orderedItems'])->name('orderedItems');
});


//ADMIN ROUTES
Route::middleware(IsAdmin::class)->group(function (){
    Route::get('/admin/home', [AdminController::class, 'adminIndex'])->name("admin.home");
    Route::resource('users', UserController::class);
    Route::resource('brands', BrandController::class);
    Route::get('/admin/products', [ProductsController::class, 'adminIndex'])->name("admin.products");
    Route::get('/admin/orders', [OrderController::class, 'adminOrders'])->name("admin.orders");
    Route::get('/admin/messages', [ContactController::class, 'listMessages'])->name('admin.messages');
});


Route::get('/en', function (Request $request){
   $log = new \App\Models\ActionLog();

   dd($log->getActions($request));
});
