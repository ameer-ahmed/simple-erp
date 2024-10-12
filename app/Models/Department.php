<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $guarded = [];

    public function managers()
    {
        return $this->hasMany(Manager::class);
    }
}
