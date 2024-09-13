<x-app-layout>
    <h1>To-Do List</h1>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
    <!-- Task Form -->
    <form action="{{ route('list.tasks.store', $toDolist) }}" method="POST" class="mb-4">
        @csrf
        <div class="flex mb-4">
        <input type="text"  class="flex-grow px-3 py-2 border rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500"  name="name" placeholder="New Task">
        <button class="px-4 py-2 bg-blue-500 text-white rounded-r-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500" type="submit">Add Task</button>
        </div>
    </form>

  
    
    @foreach ($tasks as $task)
    <div class="mt-1 py-2 hover:bg-gray-100 flex items-center"> 
        <div class="mt-1 py-2 hover:bg-gray-300 flex items-center"> 
            <form action="{{ route('tasks.update', $task) }}" method="POST" style="display:inline;">
                @csrf
                @method('PATCH')
                <input type="checkbox" name="completed" value="1" {{ $task->completed ? 'checked' : '' }} onChange="this.form.submit()">
                <span class="{{ $task->completed ? 'line-through' : '' }}">{{ $task->name }}</span>
            </form>
                        
            <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path d="M3 6v18h18v-18h-18zm5 14c0 .552-.448 1-1 1s-1-.448-1-1v-10c0-.552.448-1 1-1s1 .448 1 1v10zm5 0c0 .552-.448 1-1 1s-1-.448-1-1v-10c0-.552.448-1 1-1s1 .448 1 1v10zm5 0c0 .552-.448 1-1 1s-1-.448-1-1v-10c0-.552.448-1 1-1s1 .448 1 1v10zm4-18v2h-20v-2h5.711c.9 0 1.631-1.099 1.631-2h5.315c0 .901.73 2 1.631 2h5.712z"/></svg></button>
            </form>
        </div>


        

        </div>
    @endforeach
</div>

</div>
</div>

</x-app-layout>
