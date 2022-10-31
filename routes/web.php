<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\ResellerController;

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

Route::middleware("auth")->group(function () {
    Route::get("/", [HomeController::class, "index"])->name("home");

    Route::resource("resellers", ResellerController::class);

    Route::resource("products", ProductController::class);

    Route::resource("categories", CategoryController::class);

    Route::resource("materials", MaterialController::class);

    Route::resource("sells", SellController::class);

    Route::resource("accounts", AccountController::class);
});

Auth::routes();
