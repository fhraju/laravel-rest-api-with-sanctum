<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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

// Show all the products
Route::get('/products', [ProductController::class, 'index']);

// Show single products
Route::get('/products/{product}', [ProductController::class, 'show']);

// Search for the products
Route::get('/products/search/{name}', [ProductController::class, 'search']);

// Register an User
Route::post('/register', [UserController::class, 'register']);

// User login
Route::post('/login', [UserController::class, 'login']);

// Protected Routes
Route::middleware(['auth:sanctum'])->group(function () 
{
    // Create product
    Route::post('/products', [ProductController::class, 'store']);

    // update product
    Route::put('/products/{product}', [ProductController::class, 'update']);

    // Delete product
    Route::delete('/products/{product}', [ProductController::class, 'destroy']);

    // Log out an User
    Route::post('/logout', [UserController::class, 'logout']);

});


// with resource
//Route::resource('products', ProductController::class);

