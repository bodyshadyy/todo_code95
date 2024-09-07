<x-app-layout>
    <div class="flex flex-col items-center justify-center min-h-screen bg-green">
        <div class="bg-green p-6 rounded-lg shadow-lg">
            <h1 class="text-2xl font-bold mb-4">Pomodoro Timer</h1>
            <div id="pomodoro-count" class="text-xl font-mono mb-4">Pomodoros: 0</div>
            <div id="timer" class="text-4xl font-mono mb-4">25:00</div>
            <div class="flex space-x-4">
                <button id="start" class="bg-green-600 p-5 text-black px-4 py-2 rounded hover:bg-green-600">Start</button>
                <button id="pause" class="bg-yellow-500 text-black px-4 py-2 rounded hover:bg-yellow-600">Pause</button>
                <button id="reset" class="bg-red-500 text-black px-4 py-2 rounded hover:bg-red-600">Reset</button>
                <button id="short-break" class="bg-blue-500 text-black px-4 py-2 rounded hover:bg-blue-600">Short Break</button>
                <button id="long-break" class="bg-purple-500 text-black px-4 py-2 rounded hover:bg-purple-600">Long Break</button>
                <button id="finish" class="bg-gray-500 text-black px-4 py-2 rounded hover:bg-gray-600">Finish</button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            let timer;
            let pomodoros = 0;
            let isRunning = false;
            let isPaused = false
            let workTime=25*60
            let= // 25 minutes in seconds
            let currentMode = 'work'; // 'work', 'short-break', 'long-break'

            const timerDisplay = document.getElementById('timer');
            const pomodoroCountDisplay = document.getElementById('pomodoro-count');
            const startButton = document.getElementById('start');
            const pauseButton = document.getElementById('pause');
            const resetButton = document.getElementById('reset');
            const shortBreakButton = document.getElementById('short-break');
            const longBreakButton = document.getElementById('long-break');
            const finishButton = document.getElementById('finish');

            function updateTimerDisplay() {
                const minutes = Math.floor(timeLeft / 60);
                const seconds = timeLeft % 60;
                timerDisplay.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
            }

            function updatePomodoroCountDisplay() {
                pomodoroCountDisplay.textContent = `Pomodoros: ${pomodoros}`;
            }

            function startTimer() {
                if (isRunning) return;
                isRunning = true;
                isPaused = false;
                timer = setInterval(() => {
                    if (timeLeft <= 0) {
                        clearInterval(timer);
                        isRunning = false;
                        if (currentMode === 'work') {
                            pomodoros++;
                            updatePomodoroCountDisplay();
                        }
                        switchMode();
                    } else {
                        timeLeft--;
                        updateTimerDisplay();
                    }
                }, 1000);
            }

            function pauseTimer() {
                if (!isRunning) return;
                clearInterval(timer);
                isRunning = false;
                isPaused = true;
            }

            function resetTimer() {
                clearInterval(timer);
                isRunning = false;
                isPaused = false;
                timeLeft = 25 * 60;
                currentMode = 'work';
                updateTimerDisplay();
            }

            function startShortBreak() {
                clearInterval(timer);
                isRunning = false;
                isPaused = false;
                timeLeft = 5 * 60; // 5 minutes in seconds
                currentMode = 'short-break';
                updateTimerDisplay();
                startTimer();
            }

            function startLongBreak() {
                clearInterval(timer);
                isRunning = false;
                isPaused = false;
                timeLeft = 15 * 60; // 15 minutes in seconds
                currentMode = 'long-break';
                updateTimerDisplay();
                startTimer();
            }

            function finishPomodoro() {
                clearInterval(timer);
                isRunning = false;
                isPaused = false;
                timeLeft = 0;
                updateTimerDisplay();
                alert('Pomodoro session finished!');
            }

            function switchMode() {
                if (currentMode === 'work') {
                    startShortBreak();
                } else if (currentMode === 'short-break' || currentMode === 'long-break') {
                    resetTimer();
                }
            }

            startButton.addEventListener('click', startTimer);
            pauseButton.addEventListener('click', pauseTimer);
            resetButton.addEventListener('click', resetTimer);
            shortBreakButton.addEventListener('click', startShortBreak);
            longBreakButton.addEventListener('click', startLongBreak);
            finishButton.addEventListener('click', finishPomodoro);

            updateTimerDisplay();
            updatePomodoroCountDisplay();
        });
    </script>
</x-app-layout>