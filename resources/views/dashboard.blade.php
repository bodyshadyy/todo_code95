<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-3xl font-bold">Welcome to your dashboard</h1>



                    @foreach ($todolists[0]->tasks as $todolist)
                        <x-task-label :id="$todolist->id" :name="$todolist->name" :completed="$todolist->completed" />
                    @endforeach
                <x-task-form></x-task-form>
                <x-form-error name="name"></x-form-error>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
