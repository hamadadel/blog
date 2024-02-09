<?php

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\UserController;

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

/**
 * DB::listen(function ($query) {
    var_dump($query->sql, $query->bindings);
    });
 */

Route::get('/', function () {
    return view('welcome');
})->middleware('guest')->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/logout', [AuthController::class, 'logout']);

// Posts routes
Route::get('/posts/create', [PostController::class, 'create']);
Route::get('/posts/{post:slug}', [PostController::class, 'show']);
Route::get('/posts/{post:slug}/edit', [PostController::class, 'edit']);
Route::post('/posts', [PostController::class, 'store']);
Route::PATCH('/posts/{post:slug}', [PostController::class, 'update']);
Route::delete('/posts/{post:slug}', [PostController::class, 'destroy']);


// User Controller
Route::get('/profile/{user:username}', [UserController::class, 'profile']);
