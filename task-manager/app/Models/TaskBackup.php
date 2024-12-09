<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskBackup extends Model
{
    protected $fillable = ['task_id', 'data'];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
