<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\TransactionController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'index')->name('login')->middleware('guest');
    Route::post('/', 'authenticate')->name('login.action')->middleware('guest');
})->middleware('guest');
Route::get('/logout',[AuthController::class, 'logout'])->middleware('auth');
//home
Route::get('/home',[HomeController::class, 'index'])->middleware('auth');
//menu
Route::get('/menu', [MenuController::class, 'index'])->middleware('auth');
Route::get('/menu/search', [MenuController::class, 'cari'])->middleware('auth');
//order
Route::get('/order', [TransactionController::class, 'index'])->middleware('auth');
Route::post('/cart/{id}', [TransactionController::class, 'cart'])->middleware('auth');
Route::get('/search/menu', [MenuController::class, 'search'])->name('search.menu')->middleware('auth');
Route::post('/order', [TransactionController::class, 'store'])->middleware('auth');
Route::get('/cetakstruk/{id}', [TransactionController::class, 'cetakstruk'])->middleware('auth');
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::post('/addmenu', [MenuController::class, 'store']);
    Route::put('/editmenu/{id}', [MenuController::class, 'update']);
    Route::delete('/deletemenu/{id}', [MenuController::class, 'destroy']);
    Route::get('/history-order',[TransactionController::class,'historyOrder']);
    Route::get('/search/history', [TransactionController::class, 'search'])->name('search.history');
    Route::delete('/history-order/{id}', [TransactionController::class, 'destroy']);
});


