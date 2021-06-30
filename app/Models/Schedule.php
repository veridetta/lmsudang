<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_code','code');
    }
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_nip','nip');
    }
    public function student()
    {
        return $this->belongsTo(student::class, 'grade_code','grade_code');
    }
    public function academic()
    {
        return $this->belongsTo(Academic::class, 'academic_code','code');
    }
}
