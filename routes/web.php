<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(ProductController::class)->group(function(){
   
    Route::get('/product/create','create')->name('product.create');
    Route::post('/product','store')->name('product.store');
    Route::get('/product','index')->name('product.index');
    Route::get('/product/{product}/edit','edit')->name('product.edit');
    Route::put('/product/{product}','update')->name('product.update');
    Route::delete('/product/{product}','destroy')->name('product.destroy');
    
    
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
 