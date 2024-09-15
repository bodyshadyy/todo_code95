@php
        $pomodoroSettings = DB::table('pomodoro_settings')->where("user_id",Auth::id())->get()->first();
        $workDuration = $pomodoroSettings->pomodoro_time ?? 25;
        $shortBreakDuration = $pomodoroSettings->short_break_time ?? 5;
        $longBreakDuration = $pomodoroSettings->long_break_time ?? 15;
        $interval = $pomodoroSettings->long_break_interval ?? 4;
 @endphp
<div class="container mx-auto p-4">
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <p>Pomodoro Count: <span id="pomodoroCount"> {{$toDolist->pomo_count}}</span></p>
            <div id="timer-display" class="text-4xl font-bold text-center mb-4">{{$workDuration}}</div>
            <div class="flex justify-center mb-4">
                <button id="start" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" onclick="startTimer()">Start</button>
                <button id="reset" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline ml-2" onclick="startFocus()">Focus</button>

                <button id="short-break" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline ml-2" onclick="startShortBreak()" >Short Break</button>
                <button id="long-break" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline ml-2" onclick="startLongBreak()">Long Break</button>
                <button id="long-break" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline ml-2" onclick="test()">Long Break</button>
            </div>
        </div>
</div>


    <script>
        let timer;
        let isRunning = false;
        let timeLeft = {{$workDuration  *60}}; // 25 minutes in seconds
        let currentMode = 'work';
        let workDuration = {{$workDuration}};
        let shortBreakDuration = {{$shortBreakDuration}};
        let longBreakDuration = {{$longBreakDuration}};
        let interval = {{$interval}};
        let pomodorasCompleted =  {{$toDolist->pomo_count}};

        const timerDisplay = document.getElementById('timer-display');


        function test(){
            timeLeft = 5;
        }
        function updateTimerDisplay() {
            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;
            timerDisplay.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        }
        function switchMode(){
            // alert('Switching mode finished', currentMode);
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
                window.open("http://todo.test/focus", "_blank");

   
            }else if(currentMode === 'short-break'|| currentMode === 'long-break'){
                currentMode = 'work';
                timeLeft = workDuration * 60;
                {{ $toDolist->increment("pomo_count",1); }}
                pomodorasCompleted++;
                window.open("http://todo.test/break", "_blank");
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

        function startFocus() {
            clearInterval(timer);
            isRunning = false;
            timeLeft = workDuration * 60; // 25 minutes in seconds
            currentMode = 'work';
            updateTimerDisplay();
            startTimer() 
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
