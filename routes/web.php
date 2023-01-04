<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\PlaceController;

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

Auth::routes();

Route::get('/', [App\Http\Controllers\FindInterestingPlacesController::class, 'index'])->name('find.interesting.places');

Route::prefix('account')->middleware('auth')->group(function () {
    Route::get('/', [AccountController::class, 'index'])->name('account.index');

    Route::resource('/places', PlaceController::class);
});

