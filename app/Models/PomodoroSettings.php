<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PomodoroSettings extends Model
{
    use HasFactory;
    protected $fillable = [
        'pomodoro_time', 'short_break_time', 'long_break_time', 'long_break_interval', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
