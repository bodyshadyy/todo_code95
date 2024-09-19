<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ListController;
use App\Models\ToDolist;
use App\Models\Task;
use App\Http\Controllers\ToDolistTaskController;
use App\Http\Controllers\PomodoroSettingsController;

use App\Http\Middleware\CheckToDoListOwner;

Route::get('list/taskadsadsas', function(){
    $toDolist = ToDolist::find(session('toDolistId'));

    if (is_null($toDolist)) {
        $toDolist = auth()->user()->toDoLists()->latest()->first();
    }
    $tasks = $toDolist->tasks;
    return redirect()->route('list.tasks', $toDolist);
    
})->name('tasks.index');
// Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
// Route::patch('/tasks/{task}',[TaskController::class, 'update'])->name('tasks.update');
// Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
Route::get('/test', function () {
    session()->forget('toDolistId');
    return session()->all();
})->name('test.route');

Route::get('/list/{toDolist}/tasks',  [ToDolistTaskController::class, 'showTasks'])->name('list.tasks')->middleware(CheckToDoListOwner::class);
Route::post('/list/{toDolist}/tasks', [ToDolistTaskController::class, 'store'])->name('list.tasks.store');
Route::patch('/list/{toDolist}/tasks/{task}', [ToDolistTaskController::class, 'update'])->name('list.tasks.update');
Route::delete('/list/{toDolist}/tasks/{task}', [ToDolistTaskController::class, 'destroy'])->name('list.tasks.destroy');

Route::get('/break',function(){
    return view('break');
}
)->name('breakMessage');  
Route::get('/focus', function () {
    return view('focus');
})->name('focus');

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Route::get('/list', function () {
//     return view('list', [
//         'todolists' => auth()->user()->toDoLists
//     ]);
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/pomodoro', function () {
//     return view('pomodoro');
// })->middleware(['auth', 'verified'])->name('pomodora');

Route::get('/lists', [ListController::class,'index'])->middleware(['auth', 'verified'])->name('lists');
Route::post('/lists', [ListController::class,'store'])->middleware(['auth', 'verified'])->name('lists.store');
Route::patch('/lists/{toDolist}', [ListController::class,'update'])->middleware(['auth', 'verified'])->name('lists.update');
Route::delete('/lists/{toDolist}', [ListController::class,'destroy'])->middleware(['auth', 'verified'])->name('lists.destroy');
Route::get('/lists/{toDolist}/edit', [ListController::class,'edit'])->middleware(['auth', 'verified'])->name('lists.edit'); 
Route::get('/lists/create', [ListController::class,'create'])->middleware(['auth', 'verified'])->name('lists.create');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/settings', [PomodoroSettingsController::class, 'edit'])->name('pomodoro.settings.edit');
Route::put('/settings', [PomodoroSettingsController::class, 'update'])->name('pomodoro.settings.update');

require __DIR__.'/auth.php';
