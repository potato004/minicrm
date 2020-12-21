<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public function active_employees() {
        return $this->hasMany(Employee::class)->where('is_active', 1);
    }
}
