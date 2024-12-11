<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class TaskBackup extends Model
{
    protected $fillable = ['user_id', 'data'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
