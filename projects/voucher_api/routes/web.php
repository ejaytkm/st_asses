<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('voucher'); // define prefix with file name, refer to laravel documentation for this. etc: aaaa.blade.php
});

Route::get("/voucher/batch", [MainController::class, 'batchStatus']);
Route::get("/voucher/get", [MainController::class, 'getVoucher']);
Route::get("/voucher/stats", [MainController::class, 'getVoucherStats']);
Route::get("/voucher/claim", [MainController::class, 'claimVoucher']);