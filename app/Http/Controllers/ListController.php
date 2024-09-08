<?php

namespace App\Http\Controllers;

use App\Models\ToDolist;
use Illuminate\Http\Request;

class ListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('lists', [
            'todolists' => auth()->user()->toDoLists
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $request->collect('task');
    }

    /**
     * Display the specified resource.
     */
    public function show(ToDolist $toDolist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ToDolist $toDolist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ToDolist $toDolist)
    {
        return $toDolist;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ToDolist $toDolist)
    {
        $toDolist->delete();
        return redirect()->route('lists');
    }
}
