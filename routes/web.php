<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ComponentController;
use App\Http\Controllers\ParseController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Models\Component;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\PostCondition;

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

Route::get('/', [PostController::class, 'index']);

Route::post('/signUp', [AuthController::class, 'signUp']);

Route::post('/signIn', [AuthController::class, 'signIn']);

Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/profile', [UserController::class, 'profile']);

Route::get('/forum/{id}', [PostController::class, 'forum_view']);

Route::get('/addPost', [PostController::class, 'add_view']);

Route::get('/admin', [AdminController::class, 'index_admin']);

Route::get('/admin/moderator', [AdminController::class, 'moderator_view']);

Route::get('/admin/components', [AdminController::class, 'componets_view']);

Route::get('/admin/components/{id}/edit', [AdminController::class, 'edit_components']);

Route::post('/admin/components/update/{id}', [AdminController::class, 'update_component']);

Route::get('/admin/components/delete/{id}', [AdminController::class, 'delete_component']);

Route::get('/admin/up/{id}', [AdminController::class, 'up_user']);

Route::get('/admin/down/{id}', [AdminController::class, 'down_user']);

Route::get('/admin/processor', [ParseController::class, 'ParseProcessor']);

Route::get('/admin/GraphicCard', [ParseController::class, 'ParseGraphicCards']);

Route::get('/admin/MotherBoard', [ParseController::class, 'ParseMotherBoards']);

Route::get('/admin/PowerBlock', [ParseController::class, 'ParsePowerBlock']);

Route::get('/admin/SSD_disk', [ParseController::class, 'ParseSSD']);

Route::get('/admin/RAM', [ParseController::class, 'ParseRAM']);

Route::get('/admin/HDD', [ParseController::class, 'ParseHDD']);

Route::get('/components/{categoryId}', [ComponentController::class, 'get_category']);

Route::post('/addPost/create', [PostController::class, 'addPost']);

Route::get('/tags', [ComponentController::class, 'getTags'])->name('getTags');

Route::post('/post/like', [PostController::class, 'LikePost'])->name('post.like');

Route::post('/post/disslike', [PostController::class, 'DisslikePost'])->name('post.disslike');

Route::post('/comment/like', [PostController::class, 'LikeComment'])->name('comment.like');

Route::post('/comment/disslike', [PostController::class, 'DisslikeComment'])->name('comment.disslike');

Route::post('/forum/{id}/comment', [PostController::class, 'postComment'])->name('postComment');

Route::post('/forum/{id}/reply', [PostController::class, 'replyComment']);

Route::post('/post/favorite', [PostController::class, 'addfavorite']);

Route::get('/profile/comments', [UserController::class, 'CommentsView']);

Route::post('/profile/edit', [UserController::class, 'editUser']);

Route::get('/edit/{id}', [UserController::class, 'editPost']);

Route::get('/edit/deleteTag/{tagid}', [UserController::class, 'deleteTag']);

Route::get('/edit/deleteComponents/{componentid}', [UserController::class, 'deleteComponent']);

Route::post('/edit/store/{id}', [UserController::class, 'editPostStore']);

Route::get('/delete/{id}', [UserController::class, 'deletePost']);
