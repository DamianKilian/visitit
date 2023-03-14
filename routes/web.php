<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\FindInterestingPlacesController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\TestController;

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

Route::get('/', [FindInterestingPlacesController::class, 'index'])->name('find.interesting.places');
Route::get('/interesting-places/{slug}', [FindInterestingPlacesController::class, 'place'])->name('place');

Route::prefix('account')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::get('/', [AccountController::class, 'index'])->name('account.dashboard');
        Route::resource('/places', PlaceController::class)->except('view');
        Route::put('/places/{place}/restore', [PlaceController::class, 'restore'])->name('places.restore');
        Route::delete('/places/{place}/force-delete', [PlaceController::class, 'forceDelete'])->name('places.force.delete');
        Route::post('/trix-load-attachment', [PlaceController::class, 'trixAttachment'])->name('api.trix.attachment');
    });

Route::controller(TestController::class)->group(function () {
    Route::get('/test', 'test');
});
