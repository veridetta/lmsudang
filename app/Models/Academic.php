<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Academic extends Model
{
    use HasFactory;
    public function schedule()
    {
        return $this->hasMany(Schedule::class);
    }
    public function teacher()
    {
        return $this->hasMany(Teacher::class);
    }
}
