<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\Schedule;
use Carbon\Carbon;

class TeacherPageController extends Controller
{

    function login(){
        return view('teacher/auth/login');
    }
    function loginCheck(Request $request){
        $nip=$request->nip;
        $teacher=Teacher::where('nip','=',$request->nip)->first();
        if($teacher){
            //Auth::attempt($teacher);
            Session::put('nip', $nip);
            Session::put('id', $teacher->id);
            Session::put('name', $teacher->name);
            return redirect()->route('teacher.dashboard');
        }else{
            return view('teacher/auth/login') ->withErrors(['Periksa kembali NIP anda']);
        }
        
        //Auth::guard('teacher')->attempt($teacher);
    }
    function dashboard(){
        if(Session::get('nip')==""){
            return view('teacher/auth/login');
        }else{
            $day=Carbon::now()->format('l');
            $sc_alls=Schedule::where('teacher_id','=',Session::get('id'))->latest()->orderByRaw('DAY(day)')->orderBy('start')->paginate(5);
            $schedules = Schedule::where('day','=',$day)->where('teacher_id','=',Session::get('id'))->latest()->orderByRaw('DAY(day)')->orderBy('start')->paginate(5);
            return view('teacher/dashboard',['schedules'=>$schedules,'sc_alls'=>$sc_alls]);
        }
    }
    function startAttendance(Request $request){
        $schedule_id=$request->id;
        $start=$request->start;
        $now=Carbon::now()->addMinutes(30)->format('h:i');
        $can=Carbon::parse($now)->gt(Carbon::parse($start));
        if($can){

        }else{
            $day=Carbon::now()->format('l');
            $sc_alls=Schedule::where('teacher_id','=',Session::get('id'))->latest()->orderByRaw('DAY(day)')->orderBy('start')->paginate(5);
            $schedules = Schedule::where('day','=',$day)->where('teacher_id','=',Session::get('id'))->latest()->orderByRaw('DAY(day)')->orderBy('start')->paginate(5);
            return view('teacher/dashboard',['schedules'=>$schedules,'sc_alls'=>$sc_alls])->withErrors(['Absen dapat dilakukan minimal 30 menit sebelum kelas dimulai']);
        }

    }
}
