<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Academic extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'code',
    ];
    public function schedule()
    {
        return $this->hasMany(Schedule::class, 'code','academic_code');
    }
    public function teacher()
    {
        return $this->hasMany(Teacher::class, 'code','academic_code');
    }
}
