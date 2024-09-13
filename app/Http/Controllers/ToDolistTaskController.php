<?php

namespace App\Http\Controllers;

use App\Models\ToDolist;
use App\Models\Task;
use Illuminate\Http\Request;

class ToDolistTaskController extends Controller
{
    public function showTasks(ToDolist $toDolist)
    {
        // Retrieve the tasks associated with the to-do list
        $tasks = $toDolist->tasks()->get();

        // Return the view with the tasks and the to-do list
        return view('tasks.index', compact('tasks', 'toDolist'));
    }

    public function store(Request $request, ToDolist $toDolist)
    {
        $request->validate([
            'name' => 'required',
        ]);

        // Logic for storing a new task
        $task = new Task($request->all());
        $toDolist->tasks()->save($task);

        return redirect()->route('list.tasks', $toDolist);
    }

    public function update(Request $request, ToDolist $toDolist, Task $task)
    {

        $completed = $request->input('completed') == '1';
        $task->update(['completed' => $completed]);

        $tasks = $toDolist->tasks;
        return redirect()->route('list.tasks', $toDolist);
    }

    public function destroy(ToDolist $toDolist, Task $task)
    {
        // Logic for deleting the task
        $task->delete();

        return redirect()->route('list.tasks', $toDolist);
    }
}