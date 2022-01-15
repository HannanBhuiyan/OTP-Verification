<?php

use App\Http\Controllers\OtpController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/opt-varify', [OtpController::class, 'getVarify'])->name('opt-varify');
Route::post('/opt/store', [OtpController::class, 'otpStore'])->name('otp.store');


Route::post('/Post/VerifyOtp', [OtpController::class, 'postVerifyOtp'])->name('otp.verify');
Route::get('/getVerifyPage', [OtpController::class, 'getVarifyPage'])->name('verifyPage');
