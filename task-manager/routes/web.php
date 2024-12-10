<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriesController;
use Illuminate\Auth\AuthManager;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('/guest.login');
});

Route::middleware(['auth'])->group(function () {
   Route::get('/home',[TaskController::class,'index'])->name('user.home');
    // Route::get('/home',[CategoriesController::class,'index'])->name('user.home');
    Route::get('/task/add',[TaskController::class,'showAddForm'])->name('task.addForm');
    Route::post('/task/add',[TaskController::class,'addTask'])->name('task.add');
    Route::get('/task/edit/{id}',[TaskController::class,'showEditForm'])->name('task.edit');
    Route::post('/task/edit/{id}',[TaskController::class,'editTask'])->name('task.edit');
    Route::delete('/tasks/delete/{id}',[TaskController::class,'delete'])->name('task.delete');
    Route::post('/category/add',[CategoriesController::class, 'addCategories'])->name('categories.add');
});
Route::get('/register',[AuthController::class,'showRegisterForm'])->name('guest.registration');
Route::post('/register',[AuthController::class,'register'])->name('register');
Route::get('/login',[AuthController::class,'showLoginForm'])->name('guest.login');
Route::post('/login',[AuthController::class,'login'])->name('login');
Route::post('/logout',[AuthController::class,'logout'])->name('logout');

// Route::get('/tasks',[TaskController::class,'index'])->name('tasks');
// Route::get('/tasks/create',[TaskController::class,'create'])->name('tasks.create');
// Route::post('/tasks',[TaskController::class,'store'])->name('tasks.store');
// Route::get('/tasks/{task}/edit',[TaskController::class,'edit'])->name('tasks.edit');
// Route::put('/tasks/{task}',[TaskController::class,'update'])->name('tasks.update');
// Route::delete('/tasks/{task}',[TaskController::class,'destroy'])->name('tasks.destroy');
