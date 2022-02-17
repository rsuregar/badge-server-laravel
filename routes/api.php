<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\{IssuerController, BadgeClassController, AssertionController};

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::middleware(['auth', 'second'])->group(function () {

// });
Route::prefix('v1/ob')->group(function () {
    Route::prefix('issuers')->group(function () {
        Route::get('/', [IssuerController::class, 'index'])->name('issuer.index');
        Route::get('/{uuid}', [IssuerController::class, 'show'])->name('issuer.show');
        Route::post('/store', [IssuerController::class, 'store']);
    });

    Route::prefix('badgeclass')->group(function () {
        Route::get('/', [BadgeClassController::class, 'index'])->name('badgeClass.index');
        Route::get('/issuer/{uuid}/badge/{badgeClass:uuid}', [BadgeClassController::class, 'show'])->name('badgeClass.show');
        Route::post('/store', [BadgeClassController::class, 'store']);
    });

    Route::prefix('assertion')->group(function () {
        Route::get('/', [AssertionController::class, 'index'])->name('assertion.index');
        Route::get('/{assertion:uuid}', [AssertionController::class, 'show'])->name('assertion.show');
        Route::post('/store', [AssertionController::class, 'store']);
    });
});

