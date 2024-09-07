<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            lists
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-3xl font-bold">Welcome to your lists</h1>


                    <table class="table-auto">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Name</th>
                                <th class="px-4 py-2">Description</th>
                                <th class="px-4 py-2">completed</th>
                                <th class="px-4 py-2">created at</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($todolists as $todolist)
                            
                            <tr>
                                <a href="/dashboard">
                                <td class="border px-4 py-2"><a href="/dashboard">{{ $todolist->name }} </a></td>
                                <td class="border px-4 py-2">{{ $todolist->description }}</td>
                                <td class="border px-4 py-2">{{ $todolist->completed }}</td>
                                <td class="border px-4 py-2">{{ $todolist->created_at }}</td>
                                
                            </tr>
                           
                            @endforeach
                        </tbody>
                        
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
