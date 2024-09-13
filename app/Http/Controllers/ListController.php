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
        return view('lists.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // make descriprion not required
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
    
        ToDolist::create(['name' => $request->name, 'description' => $request->description, 'user_id' => auth()->id()]);
    
        return redirect()->route('lists');
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
        return view('listsEdit',['list' => $toDolist]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ToDolist $toDolist)
    {
        $toDolist->update(["name" => $request->name,
        "description" => $request->description]);
        return redirect()->route('lists');
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
