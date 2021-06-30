@extends('layouts.app')

@section('content')
@include('layouts.headers.general')
    
    <div class="container-fluid mt--7" id="app">
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
             @if ($message = Session::get('success'))
                    <div class="alert alert-secondary" role="alert">
                        <span class="alert-icon"><i class="ni ni-check-bold"></i></span>
                        <span class="alert-text"><strong>Info!</strong> {{ $message }}</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    @if ($message = Session::get('error'))
                    <div class="alert alert-danger" role="alert">
                        <span class="alert-icon"><i class="ni ni-fat-remove"></i></span>
                        <span class="alert-text"><strong>Info!</strong> {{ $message }}</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
            <div class="card">
                <div class="card-header">{{ __('Jadwal Hari Ini ') }}</div>

                <div class="card-body">
                    <div class="table-responsive card-body" >
                        <table class="table align-items-center table-flush sc_all w-100">
                            <thead class="thead-light">
                                <tr>
                                    <th width="20px" class="text-center">No</th>
                                    <th scope="col">Kelas</th>
                                    <th scope="col">Mapel</th>
                                    <th scope="col">Hari</th>
                                    <th scope="col">Mulai</th>
                                    <th scope="col">Selesai</th>
                                    <th scope="col">Pengajar</th>
                                    <th scope="col">Status</th>
                                    <th width="280px"class="text-center">Action</th>
                                </tr>
                            </theac>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        @include('layouts.footers.auth')
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
            {extend:'copyHtml5',title: 'Salinan Pengajar'},
            {extend:'excelHtml5',title: 'File Excel Pengajar'},
            {extend:'csvHtml5',title: 'File CSV Pengajar'},
            {extend:'pdfHtml5',title: 'File Pdf Pengajar'},
        ],
        ajax: "{{ route('admin_schedule.getToday') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'grade.name', name: 'grade.name'},
            {data: 'academic.name', name: 'academic.name'},
            {data: 'day', name: 'day'},
            {data: 'start', name: 'start'},
            {data: 'end', name: 'end'},
            {data: 'teacher.name', name: 'teacher.name'},
            {data: 'status', name: 'status'},
            {
                data: 'action', 
                name: 'action', 
                orderable: true, 
                searchable: true
            },
        ]
    });
  });
</script>
@endpush