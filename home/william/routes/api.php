<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TodoController;
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

Route::post('user/create', [UserController::class, 'Usercreate']);
Route::post('user/login', [UserController::class, 'Userlogin']);

Route::middleware(['check'])->group(function () {
    Route::get('/home', [TestController::class, 'index']);
    Route::post('/todo/list', [TodoController::class, 'listTodo']);
    Route::post('/todo/element/', [TodoController::class, 'get_one_by_id']);
    Route::post('/todo/add', [TodoController::class, 'add_todo']);
    Route::post('/todo/update', [TodoController::class, 'modif']);
    Route::post('/todo/delete', [TodoController::class, 'suppr']);
    Route::post('/todo/elementName/', [TodoController::class, 'get_one_by_name']);
});
