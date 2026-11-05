<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AuthController;

Route::get('/test', function(){
    return response()->json([
        'success' => true,
        'message' => 'Test congratulate.',
        'status' => 200,
    ], 200);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/comments', [CommentController::class, 'comment']);
});

Route::post('/login',[AuthController::class, 'api_login']);


