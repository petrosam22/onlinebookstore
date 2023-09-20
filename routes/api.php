<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\ResetPasswordController;
use App\Http\Controllers\api\ForgotPasswordController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('user')->group(function () {

Route::post('/register' , [UserController::class,'storeUser']);
Route::post('/login' , [UserController::class,'login'])->name('login');
Route::post('/ForgetPassword' , [ForgotPasswordController::class,'ForgetPassword']);
Route::post('/ResetPassword' , [ResetPasswordController::class,'ResetPassword']);
Route::post('/update/{id}' , [UserController::class,'update'])->middleware('api');
Route::post('/logout' , [UserController::class,'logout'])->middleware('auth:sanctum');
});





Route::middleware(['auth:sanctum', 'admin'])->prefix('category')->group(function () {
    Route::post('/create', [CategoryController::class, 'create']);
    Route::patch('/update/{id}', [CategoryController::class, 'update']);
    Route::get('/all', [CategoryController::class, 'categories']);
    Route::delete('/delete/{id}', [CategoryController::class, 'delete']);
    Route::get('/show/{id}', [CategoryController::class, 'show']);
});
