<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'nis',
        'address',
        'hp',
        'grade_code'
    ];
    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_code','code');
    }
}
