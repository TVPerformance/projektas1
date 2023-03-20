<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController as C;

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
Route::prefix('admin/customers')->name('customers-')->group(function () {
    Route::get('/', [C::class, 'index'])->name('index');
    Route::get('/create', [C::class, 'create'])->name('create');
    Route::post('/create', [C::class, 'store'])->name('store');
    Route::get('/edit{customer}', [C::class, 'edit'])->name('edit');
    Route::put('/edit{customer}', [C::class, 'update'])->name('update');
    Route::delete('/delete{customer}', [C::class, 'destroy'])->name('destroy');

});



Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
