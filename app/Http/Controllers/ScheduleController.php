<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Models\student;
use App\Models\Teacher;
use Session;
use App\Models\Schedule as admin_schedule;
use App\Models\Grade;
use App\Models\Academic;
use App\Models\Attendance;
use DataTables;
Use Exception;
use App\Imports\TeacherImport;
use Maatwebsite\Excel\Facades\Excel;
use Storage;
use Carbon\Carbon;
class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin_schedule.index',['countStudents'=>student::count(),'countTeachers'=>Teacher::count(),'countAcademics'=>Academic::count(),'countGrades'=>Grade::count()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule,Request $request)
    {
        $id=basename(request()->path());
        $sc=Schedule::find($id);
        $last=Attendance::where('schedule_id','=',$id)->latest('id')->first();
        $countAttendances=0;
        if($last){
            $countAttendances=Attendance::find($last->id)->count();
        }else{
            $countAttendances=0;
        }
        $task=32;
        return view('admin_schedule.show',['countStudents'=>student::where('grade_code','=',$sc->grade_code)->count(),'countAttendances'=>$countAttendances,'countTask'=>Grade::count(),'task','id'=>$id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        //
    }
    function getAll(Request $request){
        if ($request->ajax()) {
            $data=Schedule::orderByRaw('DAY(day)')->with('teacher')->with('grade')->with('academic');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    if($row->status=="Belum dimulai"){
                        $status="Mulai";
                    }else{
                        $status="Selesai"
;                    }
                    $actionBtn = '<a href="'.route('admin_staff.change',$row->id).'" class="edit btn btn-primary btn-sm">Edit</a> <form action="'.route('admin_staff.destroy',  $row->id ) .'" method="POST">
                    '.csrf_field().'
                    <input type="hidden" name="id" value="'.$row->id.'">
                    <button type="submit" class="btn btn-danger btn-sm mt-2"
                        onclick="return confirm(\'Are You Sure Want to Delete? Dapat menimbulkan error jika sudah ada riwayat data\')">
                        '.$status.'</button>
                    </form>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
    function getToday(Request $request){
        if ($request->ajax()) {
            $day=Carbon::now()->format('l');
            $data=Schedule::where('day','=',$day)->with('teacher')->with('grade')->with('academic');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    if($row->status=="Belum dimulai"){
                        $status="Mulai";
                    }else{
                        $status="Selesai"
;                    }
                    $actionBtn = '<a href="'.route('admin_schedule.show',$row->id).'" class="edit btn btn-primary btn-sm">Lihat</a> <form action="'.route('admin_schedule.start') .'" method="POST">
                    '.csrf_field().'
                    <input type="hidden" name="id" value="'.$row->id.'">
                    <input type="hidden" name="start" value="'.$row->start.'">
                    <button type="submit" class="btn btn-success btn-sm mt-2"
                        onclick="return confirm(\'Are You Sure Want to Start?\')">
                        '.$status.'</button>
                    </form>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
    public function today(){
        return view('admin_schedule.today',['countStudents'=>student::count(),'countTeachers'=>Teacher::count(),'countAcademics'=>Academic::count(),'countGrades'=>Grade::count()]);
    }
    function ExampleExcel(){
        //return response()->download(storage_path('/app/example/import-teacher.xlsx'));
        //Storage::disk('public')->download('example/', 'import-teacher.xlsx');
        $myFile = public_path("import-schedule.xlsx");
        $headers = ['Content-Type: application/xlsx'];
        $newName = 'import-schedule'.time().'.xlsx';

        return response()->download($myFile, $newName, $headers);
    }
    function start(Request $request){
        $schedule_id=$request->id;
        $start=$request->start;
        $now=Carbon::now()->addMinutes(30)->format('h:i');
        $can=Carbon::parse($now)->gt(Carbon::parse($start));
        if($can){
            return   redirect()->route('admin_schedule.today')
                        ->with('success','Absen dapat dilakukan minimal 30 menit sebelum kelas dimulai');
        }else{
            return  redirect()->route('admin_schedule.today')
                        ->with('error','Kelas dapat dimulai minimal 30 menit sebelum jadwal');
        }

    }
    function absen($stat,$kondisi){
        $ec="";
        if($stat==$kondisi){
            $ec=" enabled";
        }else{
            $ec=" disabled";
        }
        return $ec;
    }
    function getDetail(Request $request){
        $id=basename(request()->path());
        if ($request->ajax()) {
            $dat=Schedule::find($id);
            $data=Student::where('grade_code','=',$dat->grade_code);
            
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('hadir',function($row) use($dat){
                    $last=Attendance::where('schedule_id','=',$dat->id)->latest('id')->first();
                    if($last){
                        $att=Attendance::where('schedule_id','=',$dat->id)->where('user_id','=',$row->id)->where('status','=','hadir')->count();
                        $status=$att;;
                    }else{
                        $status=0;
                    }                    
                    return $status;
                })
                ->addColumn('sakit',function($row) use($dat){
                    $last=Attendance::where('schedule_id','=',$dat->id)->latest('id')->first();
                    if($last){
                        $att=Attendance::where('schedule_id','=',$dat->id)->where('user_id','=',$row->id)->where('status','=','sakit')->count();
                        $status=$att;;
                    }else{
                        $status=0;
                    }                    
                    return $status;
                })
                ->addColumn('alfa',function($row) use($dat){
                    $last=Attendance::where('schedule_id','=',$dat->id)->latest('id')->first();
                    if($last){
                        $att=Attendance::where('schedule_id','=',$dat->id)->where('user_id','=',$row->id)->where('status','=','alfa')->count();
                        $status=$att;;
                    }else{
                        $status=0;
                    }                    
                    return $status;
                })
                ->addColumn('ijin',function($row) use($dat){
                    $last=Attendance::where('schedule_id','=',$dat->id)->latest('id')->first();
                    
                    if($last){
                        $att=Attendance::where('schedule_id','=',$dat->id)->where('user_id','=',$row->id)->where('status','=','ijin')->count();
                        $status=$att;;
                    }else{
                        $status=0;
                    }                    
                    return $status;
                })
                ->addColumn('status', function($row)use($dat){
                    $absen="hadir";
                    $mulai=0;
                    if($mulai){
                        $actionBtn = '<form action="'.route('admin_schedule.start') .'" method="POST">
                    '.csrf_field().'
                    <input type="hidden" name="id" value="'.$row->id.'">
                    <input type="hidden" name="start" value="'.$dat->start.'">
                    <button type="submit" class="btn btn-success btn-sm mt-2'.Self::absen($absen,"hadir").'"
                        onclick="return confirm(\'Are You Sure Want to Start?\')">
                        H</button><form action="'.route('admin_schedule.start') .'" method="POST">
                        '.csrf_field().'
                        <input type="hidden" name="id" value="'.$row->id.'">
                        <input type="hidden" name="start" value="'.$dat->start.'">
                        <button type="submit" class="btn btn-primary btn-sm mt-2'.Self::absen($absen,"sakit").'"
                            onclick="return confirm(\'Are You Sure Want to Start?\')">
                            S</button><form action="'.route('admin_schedule.start') .'" method="POST">
                        '.csrf_field().'
                        <input type="hidden" name="id" value="'.$row->id.'">
                        <input type="hidden" name="start" value="'.$dat->start.'">
                        <button type="submit" class="btn btn-warning btn-sm mt-2'.Self::absen($absen,"ijin").'"
                            onclick="return confirm(\'Are You Sure Want to Start?\')">
                            I</button>
                            <form action="'.route('admin_schedule.start') .'" method="POST">
                    '.csrf_field().'
                    <input type="hidden" name="id" value="'.$row->id.'">
                    <input type="hidden" name="start" value="'.$dat->start.'">
                    <button type="submit" class="btn btn-danger btn-sm mt-2'.Self::absen($absen,"alfa").'"
                        onclick="return confirm(\'Are You Sure Want to Start?\')">
                        A</button>
                    </form>';
                    }else{
                        $actionBtn="Belum dimulai";
                    }
                    return $actionBtn;
                })
                ->addColumn('action', function($row)use($data){
                    $actionBtn = '<a href="'.route('admin_schedule.attDetail',$row->id).'" class="edit btn btn-primary btn-sm">Detail</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
    }
    function attDetail(Request $request){
        return view('admin_schedule.att_detail');
    }
}
