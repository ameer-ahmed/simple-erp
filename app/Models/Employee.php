<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable
{
    protected $guarded = [];
    protected $casts = [
        'password' => 'hashed',
    ];
    protected $hidden = [
        'password',
    ];

    public function manager()
    {
        return $this->belongsTo(Manager::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
