<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\SessionAuthenticate;
use Illuminate\Support\Facades\Route;


// Laravel Vue Page Routing For User
Route::get('/', [HomeController::class, 'HomePage'])->name('HomePage');
Route::get('/LoginPage', [UserController::class, 'LoginPage'])->name('LoginPage');
Route::get('/RegistrationPage', [UserController::class, 'RegistrationPage'])->name('RegistrationPage');
Route::get('/ResetPasswordPage', [UserController::class, 'ResetPasswordPage'])->name('ResetPasswordPage');
Route::get('/SendOtpPage', [UserController::class, 'SendOtpPage'])->name('SendOtpPage');
Route::get('/VerifyOtpPage', [UserController::class, 'VerifyOtpPage'])->name('VerifyOtpPage');

// Laravel Vue Page Routing For User Dashboard
Route::get('/DashboardPage', [DashboardController::class, 'DashboardPage'])->name('DashboardPage')->middleware([SessionAuthenticate::class]);
Route::get('/CategoryPage', [CategoryController::class, 'CategoryPage'])->name('CategoryPage')->middleware([SessionAuthenticate::class]);
Route::get('/CategorySavePage', [CategoryController::class, 'CategorySavePage'])->name('CategorySavePage')->middleware([SessionAuthenticate::class]);
Route::get('/ProductSavePage', [ProductController::class, 'ProductSavePage'])->name('ProductSavePage')->middleware([SessionAuthenticate::class]);

Route::get('/ProductPage', [ProductController::class, 'ProductPage'])->name('ProductPage')->middleware([SessionAuthenticate::class]);
Route::get('/ProfilePage', [UserController::class, 'ProfilePage'])->name('ProfilePage')->middleware([SessionAuthenticate::class]);

// user
Route::post('/user-registration', [UserController::class, 'userRegistration'])->name('userRegistration');
Route::post('/user-login', [UserController::class, 'userLogin'])->name('userLogin');
Route::get('/logout', [UserController::class, 'userLogout'])->name('userLogout');
Route::post('/send-otp', [UserController::class, 'SendOTPCode'])->name('SendOTPCode');
Route::post('/verify-otp', [UserController::class, 'VerifyOTP'])->name('VerifyOTP');
Route::post('/reset-password',[UserController::class,'ResetPassword'])->middleware([SessionAuthenticate::class]);
Route::get('/user-profile',[UserController::class,'UserProfile'])->middleware([SessionAuthenticate::class]);
Route::post('/user-update',[UserController::class,'UpdateProfile'])->middleware([SessionAuthenticate::class]);

// Category
Route::post("/create-category",[CategoryController::class,'CategoryCreate'])->middleware([SessionAuthenticate::class]);
Route::get("/list-category",[CategoryController::class,'CategoryList'])->middleware([SessionAuthenticate::class]);
Route::get("/delete-category/{id}",[CategoryController::class,'CategoryDelete'])->middleware([SessionAuthenticate::class]);
Route::post("/update-category",[CategoryController::class,'CategoryUpdate'])->middleware([SessionAuthenticate::class]);
Route::post("/category-by-id",[CategoryController::class,'CategoryByID'])->middleware([SessionAuthenticate::class]);

// Product API
Route::post("/create-product",[ProductController::class,'CreateProduct'])->middleware([SessionAuthenticate::class]);
Route::get("/delete-product/{id}",[ProductController::class,'DeleteProduct'])->middleware([SessionAuthenticate::class]);
Route::post("/update-product",[ProductController::class,'UpdateProduct'])->middleware([SessionAuthenticate::class]);
Route::get("/list-product",[ProductController::class,'ProductList'])->middleware([SessionAuthenticate::class]);
Route::post("/product-by-id",[ProductController::class,'ProductByID'])->middleware([SessionAuthenticate::class]);

Route::get("/summary",[DashboardController::class,'Summary'])->middleware([SessionAuthenticate::class]);