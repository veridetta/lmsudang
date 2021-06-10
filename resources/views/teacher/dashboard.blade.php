@extends('teacher.layouts.app', ['class' => 'bg-default'])

@section('content')
    @include('teacher.layouts.headers.welcome')
   <div class="container-fluid mt--9" id="app">
    <tes>
        <div class="row justify-content-center">
            @if($errors->any())
            <div class="alert alert-secondary" role="alert">
                <span class="alert-icon"><i class="ni ni-notification-70"></i></span>
                <span class="alert-text"><strong>Warning!</strong> {{$errors->first()}}</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Jadwal Hari Ini</h3>
                            </div>
                            <div class="col text-right">
                                <a data-toggle="collapse" href="#collapseSchedule" role="button" aria-expanded="false" aria-controls="collapseExample"" class="btn btn-sm btn-primary">See all</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Kelas</th>
                                    <th scope="col">Mapel</th>
                                    <th scope="col">Pengajar</th>
                                    <th scope="col">Waktu</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $n=1;?>
                            @foreach($schedules as $sc)
                                <tr>
                                   <td>{{$n}}</td>
                                   <td>{{$sc->grade->name}}</td>
                                   <td>{{$sc->academic->name}}</td>
                                   <td>{{$sc->teacher->name}}</td>
                                   <td>{{$sc->start}} - {{$sc->end}}</td>
                                   @if($sc->status="BELUM DIMULAI")
                                   <td>
                                   <form action="{{ route('teacher.startAttendance') }}" method="POST" style="display:inherit;">
                                        @csrf
                                        @method('POST')
                                        <input type="hidden" value="{{$sc->id}}" name="id"/>
                                        <input type="hidden" value="{{ $sc->start }}" name="start"/>
                                        <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Apakah Anda yakin ingin mulai mengabsen?')">MULAI ABSEN</button>
                                    </form>
                                    </td>
                                   @else
                                   <td><span class="badge badge-pill badge-primary">{{$sc->status}}</span></td>
                                   @endif
                                </tr>
                                <?php $n++;?>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $schedules ?? ''->links() !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="row collapse mb-4" id="collapseSchedule">
            <div class="col-xl-12 mt-2 mb-xl-0">
                <div class="card containter">
                <div class="table-responsive card-body" >
                        <table class="table align-items-center table-flush sc_all w-100">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Kelas</th>
                                    <th scope="col">Mapel</th>
                                    <th scope="col">Hari</th>
                                    <th scope="col">Mulai</th>
                                    <th scope="col">Selesai</th>
                                    <th scope="col">Pengajar</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </tes>
</div>
@endsection
@push('js')
<script type="text/javascript">
  $(function () {
    var table = $('.sc_all').DataTable({
        processing: true,
        serverSide: true, 
        dom: 'Bfrtip',
        language: {
                buttons: {
                    colvis : 'show / hide', // label button show / hide
                    colvisRestore: "Reset Kolom" //lael untuk reset kolom ke default
                }
        },
        buttons: [
            {extend:'copyHtml5',title: 'Salinan Jadwal'},
            {extend:'excelHtml5',title: 'File Excel Jadwal'},
            {extend:'csvHtml5',title: 'File CSV Jadwal'},
            {extend:'pdfHtml5',title: 'File Pdf Jadwal'},
        ],
        ajax: "{{ route('getScAll') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'grade.name', name: 'grade.name'},
            {data: 'academic.name', name: 'academic.name'},
            {data: 'day', name: 'day'},
            {data: 'start', name: 'start'},
            {data: 'end', name: 'end'},
            {data: 'teacher.name', name: 'teacher.name'},
        ]
    });
    
  });
</script>
@endpush