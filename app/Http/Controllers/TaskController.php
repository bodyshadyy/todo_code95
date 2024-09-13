<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\ToDoList;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Show all tasks
    public function index(Todolist $todolist)
    {
        // Retrieve the tasks associated with the to-do list
        $tasks = $todolist->tasks;

        // Return the view with the tasks
        return view('tasks.index', compact('tasks'));
    }

    // Store a new task
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
        ]);

        Task::create([
            'name' => $request->name,
            'to_do_list_id' => 1,
        ]);

        return redirect()->route('tasks.index');
    }

    // Mark a task as completed
    public function update(Request $request, Task $task): mixed|RedirectResponse
    {
        $completed = $request->input('completed') == '1';

        $task->update(['completed' => $completed]);
    
        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index');
    }
}
