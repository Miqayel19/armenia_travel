<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderStatusController;


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
Route::controller(OrderStatusController::class)->group(function () {
    Route::get('/order-statuses', 'index');
    Route::get('/order-statuses/{id}', 'show');
    Route::get('/order-statuses/{id}/edit', 'edit');
    Route::post('/order-statuses', 'store');
    Route::put('/order-statuses/{id}', 'update');
    Route::delete('/order-statuses/{id}', 'delete');
});
Route::controller(OrderController::class)->group(function () {
    Route::get('/orders', 'index');
    Route::get('/orders/create', 'create');
    Route::get('/orders/{id}', 'show');
    Route::get('/orders/{id}/edit', 'edit');
    Route::post('/orders', 'store');
    Route::put('/orders/{id}', 'update');
    Route::delete('/orders/{id}', 'delete');
});
