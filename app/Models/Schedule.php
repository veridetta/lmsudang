<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }
    public function academic()
    {
        return $this->belongsTo(Academic::class, 'academic_id');
    }
}
