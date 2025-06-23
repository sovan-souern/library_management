<?php

use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
use App\Http\Controllers\Api\V1\BookController;
use App\Http\Controllers\Api\V1\BorrowController;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\MemberController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    Route::apiResource('users', UserController::class);
    Route::apiResource('books', BookController::class);
    Route::apiResource('borrows', BorrowController::class);
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('members', MemberController::class);
});
Route::get('/users/with-books', [UserController::class, 'getUsersWithBorrowedBooks']);