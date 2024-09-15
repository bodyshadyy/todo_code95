@php
        $pomodoroSettings = DB::table('pomodoro_settings')->where("user_id",Auth::id());
        $workDuration = ($pomodoroSettings->value("pomodoro_time")) ;
        $shortBreakDuration = $pomodoroSettings->value("short_break_time") ;
        $longBreakDuration = $pomodoroSettings->value("long_break_time") ;
        $interval = $pomodoroSettings->value("long_break_interval") ;
 @endphp
{{$pomodoroSettings->value("pomodoro_duration") }}
{{$workDuration}}
{{$shortBreakDuration}}
{{$longBreakDuration}}
{{$interval}}