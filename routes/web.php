<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
Route::patch('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
Route::get('/', function () {
    return view('welcome');
})->middleware(['auth', 'verified'])->name('welcome');
Route::get('/list', function () {
    return view('list', [
        'todolists' => auth()->user()->toDoLists
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/pomodoro', function () {
    return view('pomodoro');
})->middleware(['auth', 'verified'])->name('pomodora');
Route::get('/lists', function () {
    return view('lists', [
        'todolists' => auth()->user()->toDoLists
    ]);
})->middleware(['auth', 'verified'])->name('lists');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/dashboard', [TaskController::class, 'store'
])->name('task.store');  

require __DIR__.'/auth.php';
