<?php

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TokenController;

Route::get('/', function (): View {
    return view('welcome');
})->name('welcome');

Route::prefix('api')->group(function () {
    // Token
    Route::get('/token', TokenController::class .'@index')->name('api.token');
    // Categories
    Route::get('/categories', CategoryController::class .'@index')->name('categories.index');
    Route::post('/categories', CategoryController::class .'@store')->name('categories.store');
    Route::get('/categories/{category}', CategoryController::class .'@show')->name('categories.show');
    Route::put('/categories/{category}', CategoryController::class .'@update')->name('categories.update');
    Route::delete('/categories/{category}', CategoryController::class .'@destroy')->name('categories.destroy');
});
