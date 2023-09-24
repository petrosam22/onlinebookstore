<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\AuthorController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\ResetPasswordController;
use App\Http\Controllers\api\ForgotPasswordController;
use App\Http\Controllers\api\PublisherController;
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
Route::patch('/update/{id}' , [UserController::class,'update'])->middleware('api');
Route::post('/logout' , [UserController::class,'logout'])->middleware('auth:sanctum');
});





Route::middleware(['auth:sanctum', 'admin'])->prefix('category')->group(function () {
    Route::post('/create', [CategoryController::class, 'create']);
    Route::patch('/update/{id}', [CategoryController::class, 'update']);
    Route::get('/all', [CategoryController::class, 'categories']);
    Route::delete('/delete/{id}', [CategoryController::class, 'delete']);
    Route::get('/show/{id}', [CategoryController::class, 'show']);
});

// AuthorController

Route::middleware(['auth:sanctum', 'admin'])->prefix('author')->group(function(){
    Route::get('/all',[AuthorController::class,"index"]);
    Route::post('/create',[AuthorController::class,"create"]);
    Route::patch('/update/{id}',[AuthorController::class,"update"]);
    Route::delete('/delete/{id}',[AuthorController::class,"delete"]);
    Route::get('/{id}',[AuthorController::class,"show"]);
    Route::get('/{id}/books',[AuthorController::class,"authorBooks"]);
});




Route::middleware(['auth:sanctum', 'admin'])->prefix('publisher')->group(function(){
    Route::get('/all',[PublisherController::class,"index"]);
    Route::post('/create',[PublisherController::class,"create"]);
    Route::patch('/update/{id}',[PublisherController::class,"update"]);
    Route::get('/show/{id}',[PublisherController::class,"show"]);
    Route::delete('/delete/{id}',[PublisherController::class,"destroy"]);
    Route::get('/{id}/books',[PublisherController::class,"books"]);




});