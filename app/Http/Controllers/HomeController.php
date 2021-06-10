<?php

namespace App\Http\Controllers;
use App\Models\student;
use App\Models\Teacher;
use App\Models\Grade;
use App\Models\Schedule;
use App\Models\Academic;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $students=student::all();
        $day=Carbon::now()->format('l');
        $schedules = Schedule::where('day','=',$day)->latest()->simplePaginate(5);
        return view('dashboard',['schedules'=>$schedules,'students'=>$students,'countStudents'=>student::count(),'countTeachers'=>Teacher::count(),'countAcademics'=>Academic::count(),'countGrades'=>Grade::count()])->with('i', (request()->input('page', 1) - 1) * 5);
    }
    public function tes(){
        return view('tes');
    }
}
