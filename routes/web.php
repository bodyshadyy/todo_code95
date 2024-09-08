<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ListController;
use App\Models\ToDolist;
use App\Models\Task;

Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
Route::patch('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

Route::get('/ToDolist/{ToDolist}', function ( ToDolist $todolist)  { 
    return  $todolist;
});


Route::get('/list/{ToDolist}/tasks', function ( ToDolist $todolist)  { 
    return  $todolist;
});


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

Route::get('/lists', [ListController::class,'index'])->middleware(['auth', 'verified'])->name('lists');
Route::post('/lists', [ListController::class,'store'])->middleware(['auth', 'verified'])->name('lists.store');
Route::patch('/lists/{toDolist}', [ListController::class,'update'])->middleware(['auth', 'verified'])->name('lists.update');
Route::delete('/lists/{toDolist}', [ListController::class,'destroy'])->middleware(['auth', 'verified'])->name('lists.destroy');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/dashboard', [TaskController::class, 'store'
])->name('task.store');  

require __DIR__.'/auth.php';
