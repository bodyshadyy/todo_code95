<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
        $pomodoroSettings = DB::table('pomodoro_settings')->where("user_id",Auth::id())->get()->first();
        $workDuration = $pomodoroSettings->pomodoro_time ?? 25;
        $shortBreakDuration = $pomodoroSettings->short_break_time ?? 5;
        $longBreakDuration = $pomodoroSettings->long_break_time ?? 15;
        $interval = $pomodoroSettings->long_break_interval ?? 4;
        echo $workDuration;
        echo $shortBreakDuration;
        echo $longBreakDuration;
        echo $interval;

?>      