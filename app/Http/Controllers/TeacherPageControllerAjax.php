<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\Schedule;
use Carbon\Carbon;
use DataTables;

class TeacherPageControllerAjax extends Controller
{

    function getScAll(Request $request){
        if ($request->ajax()) {
            //$data = Schedule::latest()->get();
            //$data=Schedule::where('teacher_id','=',Session::get('id'))->orderByRaw('DAY(day)')->join('grades','grades.id','=','schedules.grade_id')->join('academics','academics.id','=','schedules.academic_id')->join('teachers','teachers.id','=','schedules.teacher_id')->select('schedules.id as id','grades.name as grade_name', 'academics.name as academic_name','teachers.name as teacher_name','schedules.start as start','schedules.end as end','schedules.day as day');
            $data=Schedule::with('teacher','grade','academic')->where('teacher_id','=',Session::get('id'))->orderByRaw('DAY(day)');
            return Datatables::of($data)
                ->addIndexColumn()
                /*->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])*/
                ->make(true);
        }
    }
}
