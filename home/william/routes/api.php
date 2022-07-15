<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\JwtTestController;
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
Route::get('/home', [TestController::class, 'index']);
Route::get('/todo/list', [TodoController::class, 'liste']);
Route::get('/todo/element/{id}', [TodoController::class, 'get_one_by_id']);
Route::post('/todo/add', [TodoController::class, 'add_todo']);
Route::post('/todo/update', [TodoController::class, 'modif']);
Route::post('/todo/del', [TodoController::class, 'suppr']);
Route::get('/todo/elementName/{name}', [TodoController::class, 'get_one_by_name']);
Route::get('/jwt', [JwtTestController::class, 'index']);
Route::get('/jwt/Token', [JwtTestController::class, 'createPublicToken']);
Route::post('/jwt/Token/check/', [JwtTestController::class, 'checkToken']);
Route::post('/jwt/addUser/', [JwtTestController::class, 'createUser']);
Route::post('/jwt/login/', [JwtTestController::class, 'loginUser']);
