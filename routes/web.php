<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\DashBoardController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
// Route user
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/detail/{slug}',[HomeController::class,'detail'])->name('detail');
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'postLogin']);
Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/register', [UserController::class, 'postRegister']);
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/add-cart', [CartController::class, 'add'])->name('cart.add');

Route::get('/loginAdmin', [AdminController::class, 'login'])->name('loginAdmin');
Route::post('/loginAdmin', [AdminController::class, 'postLogin'])->name('admin.loginAdmin');
Route::get('/logoutAdmin', [AdminController::class, 'logout'])->name('admin.logout');
// Route admin
Route::prefix('admin')->middleware('admin')->group(function(){
    Route::get('/', [DashBoardController::class, 'index'])->name('admin.index');
    Route::resource('category', CategoryController::class);
    Route::get('/category-trash', [CategoryController::class, 'trash'])->name( 'category.trash' );
    Route::get('/category/restore/{id}', [CategoryController::class, 'restore'])->name( 'category.restore' );
    Route::get('/category/forceDelete/{id}', [CategoryController::class, 'forceDelete'])->name( 'category.forceDelete' );

    Route::resource('product', ProductController::class);
    Route::get('/product-trash', [ProductController::class, 'trash'])->name( 'product.trash' );
    Route::get('/product/restore/{id}', [ProductController::class, 'restore'])->name( 'product.restore' );
    Route::get('/product/forceDelete/{id}', [ProductController::class, 'forceDelete'])->name( 'product.forceDelete' );
});
