<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
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

Route::resource('products', ProductController::class);

// Search for the product
Route::get('/products/search/{name}', [ProductController::class, 'search']);

// // Show all the products
// Route::get('/products', [ProductController::class, 'index']);

// // Show single products
// Route::get('/products/{product}', [ProductController::class, 'show']);

// // Create product
// Route::post('/products', [ProductController::class, 'store']);

// // update product
// Route::put('/products/{product}', [ProductController::class, 'update']);

// // Delete product
// Route::delete('/products/{product}', [ProductController::class, 'destroy']);



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
