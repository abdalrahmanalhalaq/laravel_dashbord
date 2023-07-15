<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\EmailVerifcationController;
use App\Http\Controllers\Auth\restePasswordController;
use App\Http\Controllers\LoginAdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\parentController;
use App\Http\Controllers\responseController;
use App\Mail\AdminWelcomeEmail;
use App\Mail\UserWelcomeEmail;
use App\Models\Admin;
use App\Models\loginAdmin;
use GuzzleHttp\Middleware;
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

Route::get('/email', function () {
    $admin = Admin::first();
    return new AdminWelcomeEmail($admin);
});

Route::prefix('/Auth')->middleware('guest:admin')->group(function () {     // guest:admin -> إذا كان الزائر موثوق لا تخليه بينفع يرجع لواجهة تسجيل الدخول
    Route::get('/authLogin', [AuthController::class, 'showlogin'])->name('showlogin');
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    Route::get('/forgotPassword', [restePasswordController::class, 'forgotPassword'])->name('Password.request');
    Route::post('/forgotPassword', [restePasswordController::class, 'sendRestEmail'])->name('Password.email');
});


Route::get('/', function () {
    return view('orders/createOrder');
});
Route::get('/parentAdmin', function () {
    return view('parentAdmin');
});


Route::resource('orders', OrderController::class);
Route::resource('admins', AdminController::class)->middleware(['auth:admin', 'verified']);
// Route::resource('admins', AdminController::class);

Route::prefix('/email')->middleware('auth:admin')->group(function () {     // guest:admin -> إذا كان الزائر موثوق لا تخليه بينفع يرجع لواجهة تسجيل الدخول
    Route::get('/LogoutPage', [AuthController::class, 'logout'])->name('logout'); // 'auth:admin' سمحت بتسجيل الخروج قثط للناس اللي مسجلة دخول

    Route::get('/verify', [EmailVerifcationController::class, 'notice'])->name('verification.notice'); //الصفحة التي سيتم توجيه المستخدم عليها في حال لم يكن مفعل الحساب
    Route::get('/verification-notification', [EmailVerifcationController::class, 'send'])->middleware('throttle:6,1')->name('verification.send'); // 'auth:admin' -سمحت بتسجيل الخروج قثط للناس اللي مسجلة دخول
    Route::get('/verify/{id}/{hash}', [EmailVerifcationController::class, 'verify'])->name('verification.verify'); // 'auth:admin' <-سمحت بتسجيل الخروج قثط للناس اللي مسجلة دخول
  // {id} / اي دي الشخص المرسل الايميل
  // {hash} /تدل على ان هذا الشخص قام بعمل الايميل من النظام
  //

});

Route::resource('response', responseController::class);


// Route::get('/loginpage', [LoginAdminController::class, 'index'])->name('admin.index'); //الصفحة التي سيتم توجيه المستخدم عليها في حال لم يكن مفعل الحساب
