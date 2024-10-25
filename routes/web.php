<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\MessageController;
use App\Http\Middleware\MutualFollowMiddleware;
use App\http\Controllers\SettingsController;
use App\http\Controllers\GroupController;
use App\Models\Group;

Route::get('/', [PostController::class, 'dashboardIndex'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [PostController::class, 'dashboardIndex'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile/{user}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/{user}', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/{user}', [PostController::class, 'ProfileIndex'])->name('profile');
    Route::post('/profile/{post}/comments', [CommentController::class, 'store'])->name('comments.store');

    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::patch('/post/{post}/like', [PostController::class, 'like'])->name('post.like');
    Route::patch('/post/{post}/dislike', [PostController::class, 'dislike'])->name('post.dislike');

    Route::post('/posts', [PostController::class, 'store']);

    Route::get('/follows/select', [FollowController::class, 'listfollow'])->name('follows.select');
    Route::get('/follows/list', [FollowController::class, 'listfollow'])->name('listfollow');
    Route::get('/follows/{user}/follower', [FollowController::class, 'indexFollower'])->name('indexFollower');
    Route::get('/follows/{user}/followed', [FollowController::class, 'indexFollowed'])->name('indexFollowed');
    Route::post('/follows/{user}/add', [FollowController::class, 'addfollow'])->name('addfollow');
    Route::post('/follows/{user}/remove', [FollowController::class, 'toggleFollow'])->name('togglefollow');

    Route::get('/chat', [MessageController::class, 'index'])->name('chat');
    Route::get('/chat-select', [MessageController::class, 'index'])->name('chat.select');
    Route::get('/chat/{user}', [MessageController::class, 'show'])->name('chat.show')->middleware(MutualFollowMiddleware::class);
    Route::post('/chat/{user}', [MessageController::class, 'store'])->name('chat.store');

    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::patch('/settings', [SettingsController::class, 'update'])->name('settings.update');
    Route::delete('/settings', [SettingsController::class, 'delete'])->name('settings.delete');

    Route::get('/groups', [GroupController::class, 'indexAll'])->name('groups.indexall');
    Route::get('/groups/{user}', [GroupController::class, 'indexInGroups'])->name('groups.indexin');
    Route::get('/mygroups', [GroupController::class, 'indexMyGroups'])->name('groups.indexmy');
    Route::get('/groups/{group}', [GroupController::class, 'show'])->name('groups.show');
    Route::get('/groups/create', [GroupController::class, 'create'])->name('groups.create');
    Route::post('/groups', [GroupController::class, 'store'])->name('groups.store');
    Route::get('/groups/{group}/edit', [GroupController::class, 'edit'])->name('groups.edit');
    Route::patch('/groups/{group}', [GroupController::class, 'update'])->name('groups.update');
    Route::delete('/groups/{group}', [GroupController::class, 'delete'])->name('groups.delete');
    Route::get('/groups-select', [GroupController::class, 'indexAll'])->name('groups.select');



});


require __DIR__.'/auth.php';
