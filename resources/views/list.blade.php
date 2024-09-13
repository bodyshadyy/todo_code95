<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('lists') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-3xl font-bold">Welcome to your lists</h1>
                    @foreach ($todolists[0]->tasks as $todolist)
                        <x-task-label :id="$todolist->id" :name="$todolist->name" :completed="$todolist->completed" />
                    @endforeach
                <x-task-form></x-task-form>
                <div>
  <div class="relative w-25">
    <input type="text" name="price" id="price" class="block w-full rounded-md border-0 py-1.5  text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-10" placeholder="0.00">
    <div class="absolute inset-y-0 right-0 flex items-center">
     
      <button id="currency" name="currency" class="h-full pl-5 text-center rounded-md border-0 bg-transparent py-0 pl-2 pr-5 text-gray-500 focus:ring-2 focus:ring-inset focus:ring-indigo-600 text-3xl">
+
</button>
    </div>
  </div>
</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
