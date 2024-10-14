<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Manager extends Authenticatable
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

    protected function image() : Attribute
    {
        return Attribute::get(function ($value) {
            if ($value !== null) {
                return filter_var($value, FILTER_VALIDATE_URL) ? $value : url($value);
            }
            return '';
        });
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
