<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\TransactionController;
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

Route::get('/', [ItemController::class, 'show_item']);

Route::middleware('guest')->group(function(){
    Route::get('/register', [AuthController::class, 'register_menu'])->name('register_menu');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::get('/login', [AuthController::class, 'login_menu'])->name('login_menu');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware(['auth', 'verified']);

Route::get('/item', [ItemController::class, 'show_item'])->name('item');
Route::middleware('admin')->group(function(){
    Route::get('/item/add', [ItemController::class, 'add_item_menu'])->name('add_item_menu');
    Route::post('/item/store', [ItemController::class, 'store_item'])->name('store_item');
    Route::get('/item/edit/{id}', [ItemController::class, 'edit_item_menu'])->name('edit_item_menu');
    Route::patch('/item/update/{id}', [ItemController::class, 'update_item'])->name('update_item');
    Route::delete('/item/delete/{id}', [ItemController::class, 'delete_item'])->name('delete_item');
});

Route::get('/category', [CategoryController::class, 'show_category'])->name('category');
Route::middleware('admin')->group(function(){
    Route::get('/category/add', [CategoryController::class, 'add_category_menu'])->name('add_category_menu');
    Route::post('/category/store', [CategoryController::class, 'store_category'])->name('store_category');
    Route::get('/category/edit/{id}', [CategoryController::class, 'edit_category_menu'])->name('edit_category_menu');
    Route::patch('/category/update/{id}', [CategoryController::class, 'update_category'])->name('update_category');
    Route::delete('/category/delete/{id}', [CategoryController::class, 'delete_category'])->name('delete_category');
});

Route::get('/transaction/{id}', [TransactionController::class, 'transaction_menu'])->name('transaction_menu')->middleware(['auth']);
Route::post('/transaction/{id}/store', [TransactionController::class, 'store_transaction'])->name('store_transaction')->middleware(['auth']);