@extends('layouts.app')

@section('content')
    @include('layouts.headers.general')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
    <style>
        .dropzone {
        border: 2px dashed #dedede;
        border-radius: 5px;
        background: #f5f5f5;
        }

        .dropzone i{
        font-size: 5rem;
        }

        .dropzone .dz-message {
        color: rgba(0,0,0,.54);
        font-weight: 500;
        font-size: initial;
        text-transform: uppercase;
        }
    </style>
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
            {{-- notifikasi form validasi --}}
            @if ($errors->has('file'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('file') }}</strong>
            </span>
            @endif
            {{-- notifikasi sukses --}}
            @if ($sukses = Session::get('sukses'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button> 
                <strong>{{ $sukses }}</strong>
            </div>
            @endif
            <div class="card">
                <div class="card-header">{{ __('Import Data Pengajar') }}</div>
                <div class="card-body">
                    <button type="button" class="btn btn-primary mr-3" data-toggle="modal" data-target="#importExcel">
                        IMPORT EXCEL
                    </button>
                    <a href="{{route('admin_teacher.ExampleExcel')}}" target="_blank" class="btn btn-warning"><i class="ni ni-cloud-download-95"></i> Download Contoh</a>
                    <a class="btn btn-secondary mr-3" href="{{ route('admin_teacher.index') }}"> Back</a>
                    <div class="row col-12 mt-3 justify-content-center">
                        <div class="col-8">
                            <form action="{{route('admin_teacher.importJson')}}" method="post" enctype="multipart/form-data" id="excelUpload" class="dropzone">
                                @csrf
                                <div class="dz-message d-flex flex-column">
                                    <i class="ni ni-cloud-upload-96 text-muted"></i>
                                    Drag &amp; Drop here or click
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Import Excel -->
                    <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <form method="post" action="{{route('admin_teacher.importStore')}}" enctype="multipart/form-data">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                                    </div>
                                    <div class="modal-body">
            
                                        {{ csrf_field() }}
            
                                        <label>Pilih file excel</label>
                                        <div class="form-group">
                                            <input type="file" name="file" required="required">
                                        </div>
            
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Import</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        @include('layouts.footers.auth')
    </div>
@endsection
     <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
     <script type="text/javascript">
Dropzone.options.excelUpload = {
            maxFilesize         :       1,
            acceptedFiles: ".csv,.xls,.xlsx",
            success:function(file,done){
                window. location. reload();
            }
    };
</script>
@push('js')
@endpush