<?php

namespace App\Http\Controllers;

use App\Models\student;
use App\Models\student as admin_student;
use App\Models\Teacher;
use App\Models\Grade;
use App\Models\Schedule;
use App\Models\Academic;
use Illuminate\Http\Request;
use DataTables;
Use Exception;
use Session;
use App\Imports\StudentsImport;
use Maatwebsite\Excel\Facades\Excel;
use Storage;
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin_student.index',['countStudents'=>student::count(),'countTeachers'=>Teacher::count(),'countAcademics'=>Academic::count(),'countGrades'=>Grade::count()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grades = Grade::get();
        return view('admin_student.create',compact('grades'));
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
            'grade_code' => 'required',
            'address' => 'required',
            'nis' => 'required',
        ]);

        $student=Student::create([
            'name' => $request->name,
            'hp' => $request->hp,
            'grade_code' => $request->grade_code,
            'address' => $request->address,
            'nis' => $request->nis,
        ]);
        $student->save();
        return redirect()->route('admin_student.index')
                        ->with('success','Siswa berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(student $student, Request $request)
    {
        $students=Student::find($request->id);
        $grades = Grade::get();
        return view('admin_student.edit',compact('students','grades'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, student $student)
    {
        $request->validate([
            'name' => 'required',
            'hp' => 'required',
            'grade_code' => 'required',
            'address' => 'required',
            'nis' => 'required',
        ]);
        $up = Student::find($request->id);

        $up->name = $request->name;
        $up->hp = $request->hp;
        $up->grade_code = $request->grade_code;
        $up->address = $request->address;
        $up->nis = $request->nis;
        $up->save();
        if($up->save()){
            return redirect()->route('admin_student.index')
            ->with('success','Berhasil mengubah data');
        }else{
            dd($request);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(student $student, Request $request)
    {
        try
        {
            $flight = Student::find($request->id);
            
            $flight->delete();
            
        }
        catch(Exception $e){
        dd($e->getMessage());
        }
        return redirect()->route('admin_student.index')
        ->with('success','Siswa Berhasil dihapus');
    }
    function getAll(Request $request){
        if ($request->ajax()) {
            $data=Student::with('grade');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="'.route('admin_student.change',$row->id).'" class="edit btn btn-success btn-sm">Edit</a> <form action="'.route('admin_student.destroy',  $row->id ) .'" method="POST">
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
    function import(){
        return view('admin_student.import');
    }
    function importStore(Request $request){
        // validasi
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        // menangkap file excel
        $file = $request->file('file');

        // membuat nama file unik
        $nama_file = rand().$file->getClientOriginalName();

        // upload ke folder file_siswa di dalam folder public
        $file->move('file_student',$nama_file);

        // import data
        Excel::import(new StudentsImport, public_path('/file_student/'.$nama_file));

        // notifikasi dengan session
        Session::flash('success','Data Siswa Berhasil Diimport!');

        // alihkan halaman kembali
        return redirect('admin/student/import');
    }
    function importJson(Request $request){
        // validasi
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        // menangkap file excel
        $file = $request->file('file');

        // membuat nama file unik
        $nama_file = rand().$file->getClientOriginalName();

        // upload ke folder file_siswa di dalam folder public
        $file->move('file_student',$nama_file);

        // import data
        Excel::import(new StudentsImport, public_path('/file_student/'.$nama_file));

        // notifikasi dengan session
        Session::flash('success','Data Siswa Berhasil Diimport!');

        // alihkan halaman kembali
        return response()->json(['success' => true]);
    }
    function ExampleExcel(){
        //return response()->download(storage_path('/app/example/import-teacher.xlsx'));
        //Storage::disk('public')->download('example/', 'import-teacher.xlsx');
        $myFile = public_path("import-student.xlsx");
        $headers = ['Content-Type: application/xlsx'];
        $newName = 'import-student'.time().'.xlsx';

        return response()->download($myFile, $newName, $headers);
    }
}
