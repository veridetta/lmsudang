@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')
    
    <div class="container-fluid mt--7" id="app">
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
             @if ($message = Session::get('success'))
                    <div class="alert alert-secondary" role="alert">
                        <span class="alert-icon"><i class="ni ni-notification-70"></i></span>
                        <span class="alert-text"><strong>Info!</strong> {{ $message }}</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
            <div class="card">
                <div class="card-header">{{ __('Daftar Kelas') }}</div>

                <div class="card-body">
                    <div class="row mt-2 mb-1">
                        <div class="col-lg-12 margin-tb">
                            <div class="float-right">
                                <a class="btn btn-success btn-sm" href="{{ route('admin_grade.create') }}">Tambah Kelas</a>
                                <a class="btn btn-primary btn-sm btn-import" href="{{route('admin_grade.import')}}">Import Kelas</a>
                            </div>
                        </div>
                    </div>
                 
                    <div class="table-responsive card-body" >
                        <table class="table align-items-center table-flush sc_all w-100">
                            <thead class="thead-light">
                                <tr>
                                    <th width="20px" class="text-center">No</th>
                                    <th>Nama</th>
                                    <th>Kode Kelas</th>
                                    <th width="50px"class="text-center">Action</th>
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
            {extend:'copyHtml5',title: 'Salinan Siswa'},
            {extend:'excelHtml5',title: 'File Excel Siswa'},
            {extend:'csvHtml5',title: 'File CSV Siswa'},
            {extend:'pdfHtml5',title: 'File Pdf Siswa'},
        ],
        ajax: "{{ route('admin_grade.getAll') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'name', name: 'name'},
            {data: 'code', name: 'code'},
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