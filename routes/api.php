<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function (){
    return response()->json([
        'message' => 'Welcome to my API',
    ]);
});

Route::middleware('api')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/me', function (Request $request) {
            return $request->user();
        });

        Route::group(['middleware' => ['role:super-admin|admin']], function () {
            /*Admin services*/
            Route::get('/users', [AdminController::class, 'userIndex']); /*get all users*/
            Route::get('/users/{user}', [AdminController::class, 'UserShow']); /*get specific user info*/
            Route::post('/post', [AdminController::class, 'store']); /*Create new Post*/
            Route::patch('/posts/{post}', [AdminController::class, 'update']); /*Update specific Post*/
            Route::delete('/posts/{post}', [AdminController::class, 'destroy']); /* Delete Specific Post*/
            Route::get('/comments', [AdminController::class, 'CommentIndex']); /* get all comments that Exists*/
            Route::get('/comments/{comment}', [AdminController::class, 'CommentShow']); /*get specific info*/
        });

        /* User Services*/
        Route::put('/user', [UserController::class, 'update']);
        Route::put('/change-password', [UserController::class, 'updatePassword']); /*todo- yet to write controller*/
        Route::delete('/users/{user}', [UserController::class, 'destroy']); /*Delete Specific User*/ /*todo- should this be an admin function?*/

        /*Post Services*/
        Route::get('/posts', [PostController::class, 'index']);
        Route::get('/posts/{post}', [PostController::class, 'show']);
        Route::get('posts/{post}/comments', [PostController::class, 'comments']); /*get all comments for a post*/
        Route::get('posts/{post}/comments/{comment}', [PostController::class, 'commentById']); /*get comment by id for a post*/
        Route::post('posts/{post}/like', [PostController::class, 'like']);


        /*Comment Services*/
        Route::post('/comment/{post}', [CommentController::class, 'store']); /*create comment for a post*/
        Route::patch('/comments/{comment}', [CommentController::class, 'update']); /* update comment for a post */
        Route::delete('/comments/{comment}', [CommentController::class, 'destroy']); /*Delete comment attached to a comment*/
    });
});
