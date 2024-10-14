<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable
{
    protected $guarded = ['id'];
    protected $casts = [
        'password' => 'hashed',
    ];
    protected $hidden = [
        'password',
    ];

    protected function name() : Attribute
    {
        return Attribute::get(function () {
            return $this->first_name . ' ' . $this->last_name;
        });
    }

    public function manager()
    {
        return $this->belongsTo(Manager::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
