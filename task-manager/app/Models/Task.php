<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'task';
    protected $fillable = ['title',
     'description', 
     'due_date', 
     'status', 
     'priority', 
      'user_id'];

   
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
