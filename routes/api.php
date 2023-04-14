<?php

use App\Http\Controllers\FindInterestingPlacesController;
use App\Http\Controllers\PlaceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('account')->group(function () {
    Route::get('/slug/unique/{place?}', [PlaceController::class, 'slugUnique'])->name('api.slug.unique');
});

Route::get('/get-places', [FindInterestingPlacesController::class, 'getPlaces'])->name('api.get.places');
Route::get('/autocomplete', [FindInterestingPlacesController::class, 'autocomplete'])->name('api.autocomplete');
