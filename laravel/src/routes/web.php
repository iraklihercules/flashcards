<?php

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FlashcardController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\TokenController;

Route::get('/', function (): View {
    return view('welcome');
})->name('welcome');

Route::prefix('api')->group(function () {
    // Token
    Route::get('/csrf_token', TokenController::class .'@index')->name('api.csrf_token');
    // Categories
    Route::get('/categories', CategoryController::class .'@index')->name('categories.index');
    Route::post('/categories', CategoryController::class .'@store')->name('categories.store');
    Route::get('/categories/{category}', CategoryController::class .'@show')->name('categories.show');
    Route::put('/categories/{category}', CategoryController::class .'@update')->name('categories.update');
    Route::delete('/categories/{category}', CategoryController::class .'@destroy')->name('categories.destroy');
    // Themes
    Route::get('/themes', ThemeController::class .'@index')->name('themes.index');
    Route::post('/themes', ThemeController::class .'@store')->name('themes.store');
    Route::get('/themes/{theme}', ThemeController::class .'@show')->name('themes.show');
    Route::put('/themes/{theme}', ThemeController::class .'@update')->name('themes.update');
    Route::delete('/themes/{theme}', ThemeController::class .'@destroy')->name('themes.destroy');

    // Themes
    Route::get('/flashcards', FlashcardController::class .'@index')->name('flashcards.index');
    Route::post('/flashcards', FlashcardController::class .'@store')->name('flashcards.store');
    Route::get('/flashcards/{flashcard}', FlashcardController::class .'@show')->name('flashcards.show');
    Route::put('/flashcards/{flashcard}', FlashcardController::class .'@update')->name('flashcards.update');
    Route::delete('/flashcards/{flashcard}', FlashcardController::class .'@destroy')->name('flashcards.destroy');
});
