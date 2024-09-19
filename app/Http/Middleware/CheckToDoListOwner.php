<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\ToDoList;
use Illuminate\Support\Facades\Auth;

class CheckToDoListOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $toDoList = ToDoList::find($request->route('toDolist'))->first();
        if ($toDoList && $toDoList->user_id !== Auth::id()) {
            // return redirect()->route('list.tasks')->with('error', 'You do not have access to this to-do list.');
            return redirect()->route('lists', $toDoList)->with('error', 'You do not have access to this to-do list.');
        }

        return $next($request);
    }
}
