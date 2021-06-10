<?php

namespace App\Http\Controllers;

use App\Models\student;
use App\Models\Teacher;
use App\Models\Teacher as admin_teacher;
use App\Models\Grade;
use App\Models\Schedule;
use App\Models\Academic;
use Illuminate\Http\Request;
use DataTables;
Use Exception;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('admin_teacher.index',['countStudents'=>student::count(),'countTeachers'=>Teacher::count(),'countAcademics'=>Academic::count(),'countGrades'=>Grade::count()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $academics = Academic::get();
        return view('admin_teacher.create',compact('academics'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'hp' => 'required',
            'academic_code' => 'required',
            'address' => 'required',
            'nip' => 'required',
        ]);

        $teacher=Teacher::create([
            'name' => $request->name,
            'hp' => $request->hp,
            'academic_code' => $request->academic_code,
            'address' => $request->address,
            'nip' => $request->nip,
        ]);
        $teacher->save();
        return redirect()->route('admin_teacher.index')
                        ->with('success','Pengajar berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher, Request $request)
    {
        $teachers=Teacher::find($request->id);
        $academics = Academic::get();
        return view('admin_teacher.edit',compact('teachers','academics'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
    {
        $request->validate([
            'name' => 'required',
            'hp' => 'required',
            'academic_code' => 'required',
            'address' => 'required',
            'nip' => 'required',
        ]);
        $up = Teacher::find($request->id);

        $up->name = $request->name;
        $up->hp = $request->hp;
        $up->academic_code = $request->academic_code;
        $up->address = $request->address;
        $up->nip = $request->nip;
        $up->save();
        if($up->save()){
            return redirect()->route('admin_teacher.index')
            ->with('success','Berhasil mengubah data');
        }else{
            dd($request);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher, Request $request)
    {
        try
        {
            $flight = Teacher::find($request->id);
            
            $flight->delete();
            
        }
        catch(Exception $e){
        dd($e->getMessage());
        }
        return redirect()->route('admin_teacher.index')
        ->with('success','Pengajar Berhasil dihapus');
    }
    function getAll(Request $request){
        if ($request->ajax()) {
            $data=Teacher::with('academic');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="'.route('admin_teacher.change',$row->id).'" class="edit btn btn-success btn-sm">Edit</a> <form action="'.route('admin_teacher.destroy',  $row->id ) .'" method="POST">
                    '.csrf_field().'
                    '.method_field("DELETE").'
                    <input type="hidden" name="id" value="'.$row->id.'">
                    <button type="submit" class="btn btn-danger btn-sm mt-2"
                        onclick="return confirm(\'Are You Sure Want to Delete?\')">
                        Delete</button>
                    </form>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
