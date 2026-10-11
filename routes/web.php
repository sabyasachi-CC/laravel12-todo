<?php

use App\Http\Controllers\Web\Admin\TodoController as AdminTodoController;
use App\Http\Controllers\Web\Admin\UserController as AdminUserController;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\ProfileController;
use App\Http\Controllers\Web\TodoController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => auth()->check() ? redirect()->route('todos.index') : redirect()->route('login'))->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
});

Route::middleware(['auth', 'active'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::resource('todos', TodoController::class)->except(['index']);
    Route::get('/todos', [TodoController::class, 'index'])->name('todos.index');
});

Route::middleware(['auth', 'active', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', fn () => redirect()->route('admin.users.index'))->name('dashboard');
    Route::resource('users', AdminUserController::class)->only(['index', 'edit', 'update', 'destroy']);
    Route::get('/todos', [AdminTodoController::class, 'index'])->name('todos.index');
    Route::delete('/todos/{todo}', [AdminTodoController::class, 'destroy'])->name('todos.destroy');
});
