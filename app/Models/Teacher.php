<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'nip',
        'address',
        'hp',
        'academic_code'
    ];
    public function academic()
    {
        return $this->belongsTo(Academic::class, 'academic_code','code');
    }
    public function schedule()
    {
        return $this->hasMany(Schedule::class);
    }
}
