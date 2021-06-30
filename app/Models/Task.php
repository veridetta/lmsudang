<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'schedule_id',
        'student_id',
        'attendance_id',
        'academic_id',
        'judul',
        'isi',
        'file_name',
        'path',
        'submit'
    ];
    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'schedule_id','id');
    }
    public function student()
    {
        return $this->belongsTo(student::class, 'student_id','id');
    }
    public function attendance()
    {
        return $this->belongsTo(Attendance::class, 'attendance_id','id');
    }
    public function academic()
    {
        return $this->belongsTo(Academic::class, 'academic_id','id');
    }
}
