<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
/* Import admin controller */
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    $view['title'] = "Sell on India's Most Visited Shopping Destination | Become a seller";
    return view('auth.login', $view);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

/***************** Admin *****************/
Route::middleware('auth')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    });
});
/***************** Admin Products *****************/
Route::middleware('auth')->group(function () {
    Route::prefix('admin/products')->group(function () {
        /***************** categories *****************/
        Route::get('categories', [ProductCategoryController::class, 'index'])->name('admin.categories');
        Route::get('add-category', [ProductCategoryController::class, 'create'])->name('admin.add-category');
        Route::post('store-category', [ProductCategoryController::class, 'store'])->name('admin.store-category');
        Route::get('view-category/{id}', [ProductCategoryController::class, 'show'])->name('admin.view-category');
        Route::get('edit-category/{id}', [ProductCategoryController::class, 'edit'])->name('admin.edit-category');
        Route::patch('update-category/{id}', [ProductCategoryController::class, 'update'])->name('admin.update-category');
        Route::delete('delete-category/{id}', [ProductCategoryController::class, 'destroy'])->name('admin.delete-category');
        /***************** Products *****************/
        Route::get('/', [ProductController::class, 'index'])->name('admin.products');
        Route::get('add-product', [ProductController::class, 'create'])->name('admin.add-product');
        Route::post('store-product', [ProductController::class, 'store'])->name('admin.store-product');
        Route::get('view-product/{id}', [ProductController::class, 'show'])->name('admin.view-product');
        Route::get('edit-product/{id}', [ProductController::class, 'edit'])->name('admin.edit-product');
        Route::patch('update-product/{id}', [ProductController::class, 'update'])->name('admin.update-product');
        Route::delete('delete-product/{id}', [ProductController::class, 'destroy'])->name('admin.delete-product');
    });
    Route::prefix('users')->group(function () {
    /***************** Users *****************/
        // Route::get('/', [UserController::class, 'index'])->name('admin.users');
        // Route::get('add-user', [UserController::class, 'create'])->name('admin.add-user');
        // Route::post('store-user', [UserController::class, 'store'])->name('admin.store-user');
        // Route::get('view-user/{id}', [UserController::class, 'show'])->name('admin.view-user');
        // Route::get('edit-user/{id}', [UserController::class, 'edit'])->name('admin.edit-user');
        // Route::patch('update-user/{id}', [UserController::class, 'update'])->name('admin.update-user');
        // Route::delete('delete-user/{id}', [UserController::class, 'destroy'])->name('admin.delete-user');
    });
});
