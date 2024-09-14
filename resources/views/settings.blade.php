<x-app-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Pomodoro Settings</h1>

        <form action="{{ route('pomodoro.settings.update') }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="pomodoro_time" class="block text-gray-700 text-sm font-bold mb-2">Pomodoro Time (minutes)</label>
                <input type="number" name="pomodoro_time" id="pomodoro_time" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $settings->pomodoro_time }}">
            </div>

            <div class="mb-4">
                <label for="short_break_time" class="block text-gray-700 text-sm font-bold mb-2">Short Break Time (minutes)</label>
                <input type="number" name="short_break_time" id="short_break_time" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $settings->short_break_time }}">
            </div>

            <div class="mb-4">
                <label for="long_break_time" class="block text-gray-700 text-sm font-bold mb-2">Long Break Time (minutes)</label>
                <input type="number" name="long_break_time" id="long_break_time" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $settings->long_break_time }}">
            </div>

            <div class="mb-4">
                <label for="long_break_interval" class="block text-gray-700 text-sm font-bold mb-2">Long Break Interval (Pomodoros)</label>
                <input type="number" name="long_break_interval" id="long_break_interval" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $settings->long_break_interval }}">
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Update Settings</button>
            </div>
        </form>
    </div>
</x-app-layout>