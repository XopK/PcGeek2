<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ParseController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::post('/signUp', [AuthController::class, 'signUp']);

Route::post('/signIn', [AuthController::class, 'signIn']);

Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/profile', [UserController::class, 'profile']);

Route::get('/forum', [PostController::class, 'forum_view']);

Route::get('/addPost', [PostController::class, 'add_view']);

Route::get('/admin', [AdminController::class, 'index_admin']);

Route::get('/admin/Processor', [ParseController::class, 'ParseProcessor']);

Route::get('/admin/GraphicCard', [ParseController::class, 'ParseGraphicCards']);

Route::get('/admin/MotherBoard', [ParseController::class, 'ParseMotherBoards']);
