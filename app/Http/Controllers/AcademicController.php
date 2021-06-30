<?php

namespace App\Http\Controllers;

use App\Models\Academic;
use Illuminate\Http\Request;
use Session;
use App\Models\Academic as admin_academic;
use App\Models\Schedule;
use App\Models\student;
use App\Models\Teacher;
use App\Models\Grade;
use DataTables;
Use Exception;
use App\Imports\AcademicImport;
use Maatwebsite\Excel\Facades\Excel;
use Storage;

class AcademicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('admin_academic.index',['countStudents'=>student::count(),'countTeachers'=>Teacher::count(),'countAcademics'=>Academic::count(),'countGrades'=>Grade::count()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin_academic.create');
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

        $grade=Academic::create([
            'name' => $request->name,
            'code' => $request->code,
        ]);
        $grade->save();
        return redirect()->route('admin_academic.index')
                        ->with('success','Pelajaran berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Academic  $academic
     * @return \Illuminate\Http\Response
     */
    public function show(Academic $academic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Academic  $academic
     * @return \Illuminate\Http\Response
     */
    public function edit(Academic $academic, Request $request)
    {
        $academics=Academic::find($request->id);
        return view('admin_academic.edit',compact('academics'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Academic  $academic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Academic $academic)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required',
        ]);
        $up = Academic::find($request->id);

        $up->name = $request->name;
        $up->code = $request->code;
        $up->save();
        if($up->save()){
            return redirect()->route('admin_academic.index')
            ->with('success','Berhasil mengubah data');
        }else{
            dd($request);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Academic  $academic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Academic $academic, Request $request)
    {
        try
        {
            $flight = Academic::find($request->id);
            
            $flight->delete();
            
        }
        catch(Exception $e){
        dd($e->getMessage());
        }
        return redirect()->route('admin_academic.index')
        ->with('success','Pelajaran Berhasil dihapus');
    }
    function getAll(Request $request){
        if ($request->ajax()) {
            $data=Academic::get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="'.route('admin_academic.change',$row->id).'" class="edit btn btn-success btn-sm">Edit</a> <form class="d-inline" action="'.route('admin_academic.destroy',  $row->id ) .'" method="POST">
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
        return view('admin_academic.import');
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
        $file->move('file_academic',$nama_file);

        // import data
        Excel::import(new AcademicImport, public_path('/file_academic/'.$nama_file));

        // notifikasi dengan session
        Session::flash('sukses','Data Pelajaran Berhasil Diimport!');

        // alihkan halaman kembali
        return redirect('admin/academic/import');
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
        $file->move('file_academic',$nama_file);

        // import data
        Excel::import(new AcademicImport, public_path('/file_academic/'.$nama_file));

        // notifikasi dengan session
        Session::flash('sukses','Data Pelajaran Berhasil Diimport!');
        return response()->json(['success' => true]);
    }
    function ExampleExcel(){
        //return response()->download(storage_path('/app/example/import-teacher.xlsx'));
        //Storage::disk('public')->download('example/', 'import-teacher.xlsx');
        $myFile = public_path("import-academic.xlsx");
        $headers = ['Content-Type: application/xlsx'];
        $newName = 'import-academic'.time().'.xlsx';

        return response()->download($myFile, $newName, $headers);
    }
}
