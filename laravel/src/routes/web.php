<?php

use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

Route::get('/', function (): View {
    return view('welcome');
})->name('welcome');

Route::get('/api/token', function (): JsonResponse {
    return response()->json(['_token' => csrf_token()]);
})->name('api.token');

Route::prefix('api')->group(function () {
    Route::get('/categories', CategoryController::class .'@index')->name('categories.index');
    Route::post('/categories', CategoryController::class .'@store')->name('categories.store');
    Route::get('/categories/{category}', CategoryController::class .'@show')->name('categories.show');
    Route::put('/categories/{category}', CategoryController::class .'@update')->name('categories.update');
    Route::delete('/categories/{category}', CategoryController::class .'@destroy')->name('categories.destroy');
});
