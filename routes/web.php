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

Route::get('/', [PostController::class, 'dashboardIndex'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [PostController::class, 'dashboardIndex'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::prefix('profile')->group(function () {
        Route::get('/{user}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/{user}', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('/{user}', [PostController::class, 'ProfileIndex'])->name('profile');
        Route::post('/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    });

    Route::prefix('posts')->group(function () {
        Route::post('/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
        Route::post('/', [PostController::class, 'store']);
    });

    Route::prefix('follows')->controller(FollowController::class)->group(function () {
        Route::get('/select', 'listfollow')->name('follows.select');
        Route::get('/list', 'listfollow')->name('listfollow');
        Route::get('/{user}/follower', 'indexFollower')->name('indexFollower');
        Route::get('/{user}/followed', 'indexFollowed')->name('indexFollowed');
        Route::post('/{user}/add', 'addfollow')->name('addfollow');
        Route::post('/{user}/remove', 'toggleFollow')->name('togglefollow');
    });

    Route::controller(MessageController::class)->group(function () {
        Route::get('/chat', 'index')->name('chat');
        Route::get('/chat-select', 'index')->name('chat.select');
        Route::get('/chat/{user}', 'show')->name('chat.show')->middleware(MutualFollowMiddleware::class);
        Route::post('/chat/{user}', 'store')->name('chat.store');
    });

    Route::prefix('settings')->controller(SettingsController::class)->group(function () {
        Route::get('/', 'index')->name('settings.index');
        Route::patch('/', 'update')->name('settings.update');
        Route::delete('/', 'delete')->name('settings.delete');
    });


    Route::controller(GroupController::class)->group(function () {
        Route::get('/groups','indexAll')->name('groups.indexall');
        Route::get('/groups/in', 'indexInGroups')->name('groups.indexin');
        Route::get('/groups/my', 'indexMyGroups')->name('groups.indexmy');
        Route::get('/groups/{group}', 'show')->name('groups.show');
        Route::get('/group/create', 'create')->name('groups.create');
        Route::post('/groups', 'store')->name('groups.store');
        Route::get('/groups/{group}/edit', 'edit')->name('groups.edit');
        Route::patch('/groups/{group}', 'update')->name('groups.update');
        Route::delete('/groups/{group}', 'delete')->name('groups.delete');
        Route::get('/groups-select', 'indexAll')->name('groups.select');

        Route::post('/groups/{group}/join', 'join')->name('group.join');
        Route::post('/groups/{group}/leave', 'leave')->name('group.leave');
        Route::get('/groups/{group}/members', 'list')->name('group.members');
    });



});


require __DIR__.'/auth.php';
