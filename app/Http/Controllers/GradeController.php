<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;
use Session;
use App\Models\Grade as admin_grade;
use App\Models\Schedule;
use App\Models\student;
use App\Models\Teacher;
use App\Models\Academic;
use DataTables;
Use Exception;
use App\Imports\GradeImport;
use Maatwebsite\Excel\Facades\Excel;
use Storage;
class GradeController extends Controller
{
    public function index()
    {
        
        return view('admin_grade.index',['countStudents'=>student::count(),'countTeachers'=>Teacher::count(),'countAcademics'=>Academic::count(),'countGrades'=>Grade::count()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin_grade.create');
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
            'code' => 'required',
        ]);

        $grade=Grade::create([
            'name' => $request->name,
            'code' => $request->code,
        ]);
        $grade->save();
        return redirect()->route('admin_grade.index')
                        ->with('success','Kelas berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function show(Grade $grade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function edit(Grade $grade, Request $request)
    {
        $grades=Grade::find($request->id);
        return view('admin_grade.edit',compact('grades'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Grade $grade)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required',
        ]);
        $up = Grade::find($request->id);

        $up->name = $request->name;
        $up->code = $request->code;
        $up->save();
        if($up->save()){
            return redirect()->route('admin_grade.index')
            ->with('success','Berhasil mengubah data');
        }else{
            dd($request);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Grade  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grade $grade, Request $request)
    {
        try
        {
            $flight = Grade::find($request->id);
            
            $flight->delete();
            
        }
        catch(Exception $e){
        dd($e->getMessage());
        }
        return redirect()->route('admin_grade.index')
        ->with('success','Kelas Berhasil dihapus');
    }
    function getAll(Request $request){
        if ($request->ajax()) {
            $data=Grade::get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="'.route('admin_grade.change',$row->id).'" class="edit btn btn-success btn-sm">Edit</a> <form class="d-inline" action="'.route('admin_grade.destroy',  $row->id ) .'" method="POST">
                    '.csrf_field().'
                    '.method_field("DELETE").'
                    <input type="hidden" name="id" value="'.$row->id.'">
                    <button type="submit" class="btn btn-danger btn-sm"
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
        return view('admin_grade.import');
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
        $file->move('file_grade',$nama_file);

        // import data
        Excel::import(new GradeImport, public_path('/file_grade/'.$nama_file));

        // notifikasi dengan session
        Session::flash('sukses','Data Kelas Berhasil Diimport!');

        // alihkan halaman kembali
        return redirect('admin/grade/import');
    }
    function importJson(Request $request){
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        // menangkap file excel
        $file = $request->file('file');

        // membuat nama file unik
        $nama_file = rand().$file->getClientOriginalName();

        // upload ke folder file_siswa di dalam folder public
        $file->move('file_grade',$nama_file);

        // import data
        Excel::import(new GradeImport, public_path('/file_grade/'.$nama_file));

        // notifikasi dengan session
        Session::flash('sukses','Data Kelas Berhasil Diimport!');
        return response()->json(['success' => true]);
    }
    function ExampleExcel(){
        //return response()->download(storage_path('/app/example/import-teacher.xlsx'));
        //Storage::disk('public')->download('example/', 'import-teacher.xlsx');
        $myFile = public_path("import-grade.xlsx");
        $headers = ['Content-Type: application/xlsx'];
        $newName = 'import-grade'.time().'.xlsx';

        return response()->download($myFile, $newName, $headers);
    }
}
