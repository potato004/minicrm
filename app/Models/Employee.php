<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    // public function company() {
    //     return $this->belongsTo(Company::class);
    // }

    public function company() {
        return $this->belongsTo(Company::class)->where('is_active', 1);
    }
}
