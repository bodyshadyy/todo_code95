<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PomodoroSettings;
use Illuminate\Support\Facades\Auth;


class PomodoroSettingsController extends Controller
{
    public function edit()
    {
        $settings = PomodoroSettings::where('user_id', Auth::id())->first();
        return view('settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'pomodoro_time' => 'required|integer|min:1',
            'short_break_time' => 'required|integer|min:1',
            'long_break_time' => 'required|integer|min:1',
            'long_break_interval' => 'required|integer|min:1',
        ]);

        $settings = PomodoroSettings::where('user_id', Auth::id())->firstOrFail();
        $settings->update($request->all());

        return redirect()->route('pomodoro.settings.edit')->with('success', 'Settings updated successfully.');
    }
}
