<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\api\UserController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('/register' , [UserController::class,'storeUser']);
Route::post('/login' , [UserController::class,'login']);
Route::post('/ForgetPassword' , [ForgotPasswordController::class,'ForgetPassword']);
Route::post('/ResetPassword' , [ResetPasswordController::class,'ResetPassword']);
Route::post('/update/{id}' , [UserController::class,'update'])->middleware('api');




