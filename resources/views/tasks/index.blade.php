<x-app-layout>
    <h1>To-Do List</h1>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
    <!-- Task Form -->
    <x-pomodoro :toDolist="$toDolist" />

    <form action="{{ route('list.tasks.store', $toDolist) }}" method="POST" class="mb-4">
        @csrf
        <div class="flex mb-4">
        <input type="text"  class="flex-grow px-3 py-2 border rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500"  name="name" placeholder="New Task">
        <button class="px-4 py-2 bg-blue-500 text-white rounded-r-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500" type="submit">Add Task</button>
        </div>
    </form>

  
    
    @foreach ($tasks as $task)
    <div class="mt-1 py-2 hover:bg-gray-100 flex items-center"> 
        <div class="mt-1 py-2  flex items-center"> 
            <form action="{{ route('list.tasks.update', ['task'=>$task,'toDolist'=>$toDolist]) }}" method="POST" style="display:inline;">
                @csrf
                @method('PATCH')
                <input id="task-{{ $task->id }}" type="checkbox" name="completed" value="1" {{ $task->completed ? 'checked' : '' }} onChange="this.form.submit()">
                <label for="task-{{ $task->id }}" class="{{ $task->completed ? 'line-through' : '' }}">{{ $task->name }}</label>
            </form>
                        
            <form action="{{ route('list.tasks.destroy', ['task'=>$task,'toDolist'=>$toDolist]) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="ml-2"><x-deleteIcon/></button>
            </form>
        </div>


        

        </div>
    @endforeach
</div>

</div>
</div>

</x-app-layout>
