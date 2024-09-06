<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToDoList extends Model
{
    use HasFactory;
    public   $gaudrded = [];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
