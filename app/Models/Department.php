<?php

namespace App\Models;

use App\Http\Enums\TaskStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $guarded = ['id'];

    public function isDeletable(): Attribute
    {
        return Attribute::get(function () {
            return $this->managers()->whereDoesntHave('tasks', function ($query) {
                $query->where('status', '!=', TaskStatus::DONE->value);
            })->exists();
        });
    }

    public function managers()
    {
        return $this->hasMany(Manager::class);
    }

    public function employees()
    {
        return $this->hasManyThrough(Employee::class, Manager::class);
    }
}
