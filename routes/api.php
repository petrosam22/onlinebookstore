<?php

use App\Models\Book;
use App\Models\Cart;
use App\Models\Post;
use App\Models\User;
use App\Models\Replay;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\api\BookController;
use App\Http\Controllers\api\CartController;
use App\Http\Controllers\api\PostController;
use App\Http\Controllers\api\RateController;
use  App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\AuthorController;
use App\Http\Controllers\api\RefundController;
use App\Http\Controllers\api\ReplayController;
use App\Http\Controllers\api\ReviewController;
use App\Http\Controllers\api\CommentController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\PublisherController;
use App\Http\Controllers\api\OrderStatusController;
use App\Http\Controllers\api\OrderDeliverController;
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



// User Authentication
Route::prefix('user')->group(function () {
Route::post('/register' , [UserController::class,'storeUser']);
Route::post('/login' , [UserController::class,'login'])->name('login');
Route::post('/ForgetPassword' , [ForgotPasswordController::class,'ForgetPassword']);
Route::post('/ResetPassword' , [ResetPasswordController::class,'ResetPassword']);
Route::patch('/update/{id}' , [UserController::class,'update'])->middleware('api');
Route::post('/logout' , [UserController::class,'logout'])->middleware('auth:sanctum');
});




//Category Crud Admin Only
Route::middleware(['auth:sanctum', 'admin','throttle:api'])->prefix('category')->group(function () {
    Route::post('/create', [CategoryController::class, 'create']);
    Route::patch('/update/{id}', [CategoryController::class, 'update']);
    Route::get('/all', [CategoryController::class, 'categories']);
    Route::delete('/delete/{id}', [CategoryController::class, 'delete']);
    Route::get('/show/{id}', [CategoryController::class, 'show']);
});



//Author Crud Admin Only
Route::middleware(['auth:sanctum', 'admin','throttle:api'])->prefix('author')->group(function(){
    Route::post('/create',[AuthorController::class,"create"]);
    Route::patch('/update/{id}',[AuthorController::class,"update"]);
    Route::delete('/delete/{id}',[AuthorController::class,"delete"]);
});




//Author CRUD
Route::middleware(['auth:sanctum','throttle:api'])->group(function(){
Route::get('author/{id}/books',[AuthorController::class,"authorBooks"]);
Route::get('author/{id}',[AuthorController::class,"show"]);
Route::get('authors',[AuthorController::class,"index"]);
});

//Publisher Crud Admin Only
Route::middleware(['auth:sanctum', 'admin','throttle:api'])->prefix('publisher')->group(function(){
    Route::get('/all',[PublisherController::class,"index"]);
    Route::post('/create',[PublisherController::class,"create"]);
    Route::patch('/update/{id}',[PublisherController::class,"update"]);
    Route::get('/show/{id}',[PublisherController::class,"show"]);
    Route::delete('/delete/{id}',[PublisherController::class,"destroy"]);
    Route::get('/{id}/books',[PublisherController::class,"books"]);




});

//Book Crud Admin Only
Route::middleware(['auth:sanctum' , 'admin','throttle:api'])->prefix('book')->group(function(){
Route::post('/create' , [BookController::class ,'store']);
Route::patch('/update/{id}' , [BookController::class ,'update']);
Route::delete('/delete/{id}' , [BookController::class ,'destroy']);
Route::post('/{bookId}' , [BookController::class ,'addCategory']);
});


//User
Route::middleware(['auth:sanctum','throttle:api'])->prefix('books')->group(function(){
Route::get('/{id}' , [BookController::class ,'show']);
Route::get('/' , [BookController::class ,'index']);
Route::get('/category/{id}' , [BookController::class ,'bookCategory'])->middleware('auth:sanctum');
});


//Cart Crud
Route::middleware(['auth:sanctum','throttle:api'])->prefix('cart')->group(function(){
Route::post('/create/{id}' , [CartController::class,'store']);
Route::patch('/update/{id}/{bookId}' , [CartController::class,'update']);
Route::get('/user/{id}' , [CartController::class,'userCarts']);
Route::delete('/delete/{id}' , [CartController::class,'destroy']);
Route::get('/{id}' , [CartController::class,'show']);
});


//Post Crud

 
Route::middleware(['auth:sanctum' , 'throttle:api'])->prefix('post')->group(function(){
Route::post('/create' , [PostController::class,'store']);
Route::post('/update/{id}' , [PostController::class,'update']);
Route::get('/all' , [PostController::class,'index'])->name('posts');
Route::get('/show/{id}' , [PostController::class,'show']);
Route::get('/find/{id}' , [PostController::class,'find']);
Route::delete('/delete/{id}' , [PostController::class,'destroy'])->name('delete');
Route::get('/users' , [PostController::class,'usersPost']);
Route::get('/user/{id}' , [PostController::class,'getPostsByUser']);

});



// Comment Crud
Route::middleware(['auth:sanctum','throttle:api'])->prefix('comment')->group(function(){
    Route::get('/all' , [CommentController::class ,'index']);
    Route::post('/store/{id}' , [CommentController::class ,'store']);
Route::patch('/update/{id}' , [CommentController::class ,'update']);
Route::delete('/delete/{id}' , [CommentController::class ,'destroy']);
Route::get('/user/{id}' , [CommentController::class ,'userComments']);
Route::get('/post/{id}' , [CommentController::class ,'listCommentsPost']);
});

//Replay Crud
Route::middleware(['auth:sanctum','throttle:api'])->prefix('replay')->group(function(){
    Route::get('all' , [ReplayController::class,'index']);
    Route::post('/store/{id}' , [ReplayController::class,'store']);
Route::patch('/update/{replay}' , [ReplayController::class,'update']);
Route::delete('/delete/{replay}' , [ReplayController::class,'destroy']);
});



//Rate Crud
Route::middleware(['auth:sanctum','throttle:api'])->prefix('rate')->group(function(){
    Route::post('/store/{book}' , [RateController::class,'store']);
    Route::patch('/update/{id}' , [RateController::class,'update']);
Route::delete('/delete/{id}' , [RateController::class,'destroy']);
Route::get('/all' , [RateController::class,'index']);
Route::get('/book/{book}' , [RateController::class,'bookRates']);
Route::get('/calc/{book}' , [RateController::class,'calculateBookRate']);
});



//Review Crud
Route::middleware(['auth:sanctum','throttle:api'])->prefix('review')->group(function(){
Route::post('/store', [ReviewController::class,'store']);
Route::post('/update/{id}', [ReviewController::class,'update']);
Route::get('/book/{book}', [ReviewController::class,'bookReviews']);
Route::get('/all', [ReviewController::class,'index']);
Route::delete('/delete/{id}', [ReviewController::class,'destroy']);
});



//Order Crud
Route::middleware(['auth:sanctum','throttle:api'])->prefix('order')->group(function(){
Route::post('/create', [OrderController::class,'store']);
Route::patch('/update/{id}', [OrderController::class,'update']);
Route::post('/stripe/{order}', [OrderController::class,'stripe']);
Route::delete('/delete/{order}', [OrderController::class,'destroy']);
Route::get('all', [OrderController::class,'index'])->middleware(['admin']);
Route::post('/close/{order}', [OrderController::class,'closeOrder'])->middleware(['admin']);
});





//orderStatus Crud Admin Only
Route::middleware(['auth:sanctum','admin','throttle:api'])->prefix('orderStatus')->group(function(){
Route::get('/all',[OrderStatusController::class,'index']);
Route::post('/store',[OrderStatusController::class,'store']);
Route::patch('/update/{id}',[OrderStatusController::class,'update']);
Route::delete('/delete/{id}',[OrderStatusController::class,'destroy']);
Route::post('/changeStatus/{order}',[OrderStatusController::class,'changeStatus']);
Route::get('/orders/{id}',[OrderStatusController::class,'ordersByStatusId']);

});



//OrderDeliver Crud Admin Only

Route::middleware(['auth:sanctum','admin','throttle:api'])->prefix('OrderDeliver')->group(function(){
Route::post('/store/{order}',[OrderDeliverController::class , 'store']);
Route::get('/all',[OrderDeliverController::class , 'index']);
Route::patch('/update/{id}',[OrderDeliverController::class , 'update']);
Route::delete('/delete/{id}',[OrderDeliverController::class , 'destroy']);

});


//Refund Crud
Route::middleware(['auth:sanctum','throttle:api'])->prefix('refund')->group(function(){
Route::post('/create/{order}' ,[RefundController::class,'store']);
Route::post('/update/{refund}' ,[RefundController::class,'update']);
Route::get('/orders' ,[RefundController::class,'orderThatRefund']);

});



Route::get('/test',function(){
return "ss";

});
