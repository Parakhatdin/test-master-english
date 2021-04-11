<?php

use App\Http\Controllers\BooksController;
use App\Http\Controllers\PartsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('books', [BooksController::class, 'index']);
Route::get('books/{book_id}', [BooksController::class, 'show']);
Route::get('books/{book_id}/parts', [PartsController::class, 'index']);
Route::get('books/{book_id}/parts/{part_id}', [PartsController::class, 'show']);
//Route::get('books/{book}/parts/{part}/chapters', [BooksController::class, 'index']);
//Route::get('books/{book}/parts/{part}/chapters/{chapter}', [BooksController::class, 'index']);
