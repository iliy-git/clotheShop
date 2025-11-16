<?php

use App\Http\Controllers\BasketController;
use App\Http\Controllers\ClotheController;
use Illuminate\Support\Facades\Route;

//Route::get('/', [ClotheController::class, 'index'])->name('home');
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', function () {
    return redirect()->route('home');
})->middleware(['auth'])->name('dashboard');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/clothes', [ClotheController::class, 'index'])->name('clothes.index');
Route::get('/clothes/{clothe}', [ClotheController::class, 'show'])->name('clothes.show');

Route::middleware('auth')->group(function () {
    Route::get('/basket', [BasketController::class, 'index'])->name('basket.index');
    Route::post('/basket/add/{clothe}', [BasketController::class, 'add'])->name('basket.add');
    Route::put('/basket/update/{basket}', [BasketController::class, 'update'])->name('basket.update');
    Route::delete('/basket/remove/{basket}', [BasketController::class, 'destroy'])->name('basket.remove');
});

require __DIR__.'/auth.php';
