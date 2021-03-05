<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\ExpenseController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\POSController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\SalaryController;
use App\Http\Controllers\Api\SupplierController;
use App\Http\Controllers\AuthController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('dashboard', DashboardController::class);

Route::apiResource('employee', EmployeeController::class);
Route::get('search/employee/{query}', [EmployeeController::class, 'search']);

Route::apiResource('supplier', SupplierController::class);
Route::get('search/supplier/{query}', [SupplierController::class, 'search']);

Route::apiResource('category', CategoryController::class);
Route::get('search/category/{query}', [CategoryController::class, 'search']);

Route::apiResource('product', ProductController::class);
Route::get('search/product/{query}', [ProductController::class, 'search']);

Route::apiResource('expense', ExpenseController::class);
Route::get('search/expense/{query}', [ExpenseController::class, 'search']);

Route::apiResource('salary', SalaryController::class);
Route::get('allEmployee', [SalaryController::class, 'allEmployee']);
Route::get('search/salary/{query}', [SalaryController::class, 'search']);

Route::apiResource('customer', CustomerController::class);
Route::get('search/customer/{query}', [CustomerController::class, 'search']);

Route::apiResource('order', OrderController::class);
Route::get('search/order/{query}', [OrderController::class, 'search']);

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);

});

Route::group(['prefix' => 'pos'], function(){
    Route::get('category', [POSController::class, 'categories']);
    Route::get('product', [POSController::class, 'products']);
    Route::get('product/{id}', [POSController::class, 'getCategoryProducts']);
    Route::get('search/product/{category_id}/{query}', [POSController::class, 'searchProduct']);
    Route::get('customer', [POSController::class, 'customer']);
    Route::get('cart/{id}', [POSController::class, 'getCartByCustomer']);
    Route::get('cart/{product_id}/{customer_id}', [POSController::class, 'storeCartByCustomer']);
    Route::delete('cart/{id}/{customer_id}', [POSController::class, 'destroyCart']);
    Route::put('cart-sum/{id}', [POSController::class, 'sumCart']);
    Route::put('cart-minus/{id}', [POSController::class, 'minusCart']);
});
