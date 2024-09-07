<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard', [
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
Route::post('/dashboard', [TaskController::class, 'store'
])->name('task.store');  

require __DIR__.'/auth.php';
