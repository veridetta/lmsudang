<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'code',
    ];
    public function schedule()
    {
        return $this->hasMany(Schedule::class);
    }
    public function student()
    {
        return $this->hasMany(Student::class);
    }
}
