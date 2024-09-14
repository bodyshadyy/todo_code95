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
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Pomodoro Timer {{$toDolist->pomo_count}}</h1>

        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <p>Pomodoro Count: <span id="pomodoroCount">0</span></p>
            <div id="timer-display" class="text-4xl font-bold text-center mb-4">25:00</div>
            <div class="flex justify-center mb-4">
                <button id="start" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" onclick="startTimer()">Start</button>
                <button id="reset" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline ml-2" onclick="resetTimer()">Reset</button>
            </div>
            <div class="flex justify-center">
                <button id="short-break" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" onclick="startShortBreak()" >Short Break</button>
                <button id="long-break" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline ml-2" onclick="startLongBreak()">Long Break</button>
            </div>
        </div>
    </div>

  
    
    @foreach ($tasks as $task)
    <div class="mt-1 py-2 hover:bg-gray-100 flex items-center"> 
        <div class="mt-1 py-2 hover:bg-gray-300 flex items-center"> 
            <form action="{{ route('list.tasks.update', ['task'=>$task,'toDolist'=>$toDolist]) }}" method="POST" style="display:inline;">
                @csrf
                @method('PATCH')
                <input type="checkbox" name="completed" value="1" {{ $task->completed ? 'checked' : '' }} onChange="this.form.submit()">
                <span class="{{ $task->completed ? 'line-through' : '' }}">{{ $task->name }}</span>
            </form>
                        
            <form action="{{ route('list.tasks.destroy', ['task'=>$task,'toDolist'=>$toDolist]) }}" method="POST" style="display:inline;">
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
@php
        $pomodoroSettings = DB::table('pomodoro_settings')->first();
        $workDuration = $pomodoroSettings->work_duration ?? 25;
        $shortBreakDuration = $pomodoroSettings->short_break_duration ?? 5;
        $longBreakDuration = $pomodoroSettings->long_break_duration ?? 15;
        $interval = $pomodoroSettings->long_break_interval ?? 4;
    @endphp
    <script>
        let timer;
        let isRunning = false;
        let timeLeft = 25 * 60; // 25 minutes in seconds
        let currentMode = 'work';
        let workDuration = {{$workDuration}};
        let shortBreakDuration = {{$shortBreakDuration}};
        let longBreakDuration = {{$longBreakDuration}};
        let interval = {{$interval}};
        let pomodorasCompleted = 0;

        const timerDisplay = document.getElementById('timer-display');
        function updateTimerDisplay() {
            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;
            timerDisplay.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        }
        function switchMode(){
            if(currentMode === 'work'){

                if(pomodorasCompleted% interval ==0){
                    currentMode = 'long-break';
                    timeLeft = longBreakDuration * 60;
                }
                else{
                    currentMode = 'short-break';
                    timeLeft = shortBreakDuration * 60;
                    // timeLeft = 5;
                }

   
            }else if(currentMode === 'short-break'|| currentMode === 'long-break'){
                currentMode = 'work';
                timeLeft = workDuration * 60;
                pomodorasCompleted++;
                document.getElementById('pomodoroCount').textContent = pomodorasCompleted;
            }
            updateTimerDisplay();
        }

        function startTimer() {
            if (!isRunning) {
            document.getElementById('start').textContent = 'Pause';
            isRunning = true;
            timer = setInterval(() => {
                if (timeLeft > 0) {
                timeLeft--;
                updateTimerDisplay();
                } else {
                clearInterval(timer);
                isRunning = false;
                switchMode(); // Switch mode when timer ends
                startTimer(); // Automatically start the timer for the next mode
                }
            }, 1000);
            } else {
            document.getElementById('start').textContent = 'Start';
            clearInterval(timer);
            isRunning = false;
            }
        }

        function resetTimer() {
            clearInterval(timer);
            isRunning = false;
            timeLeft = currentMode === 'work' ? 1 * 60 : currentMode === 'short-break' ? shortBreakDuration * 60 : longBreakDuration * 60;
            updateTimerDisplay();
        }

        function startShortBreak() {
            clearInterval(timer);
            isRunning = false;
            timeLeft = shortBreakDuration * 60; // 5 minutes in seconds
            currentMode = 'short-break';
            updateTimerDisplay();
            startTimer();
        }

        function startLongBreak() {
            clearInterval(timer);
            isRunning = false;
            timeLeft = longBreakDuration * 60; // 15 minutes in seconds
            currentMode = 'long-break';
            updateTimerDisplay();
            startTimer();
        }


        updateTimerDisplay();
    </script>

</x-app-layout>
