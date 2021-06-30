@extends('layouts.app')
@section('content')
@include('layouts.headers.general')
    <div class="container-fluid mt--8" id="app">
        <div class="row mt-5">
            <div class="row col-12 justify-content-center">
                <div class="col-md-6 col-12">
                    <div class="card ">
                        <div class="card-header">{{ __('Tambah Kelas') }}</div>
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <div class="card-body">
                            <div class="row mt-2 mb-5">
                                <div class="col-lg-12 margin-tb">
                                    <div class="float-right">
                                        <a class="btn btn-secondary" href="{{ route('admin_grade.index') }}"> Back</a>
                                    </div>
                                </div>
                            </div>
                        
                            <form action="{{ route('admin_grade.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Nama Kelas:</strong>
                                            <input type="text" name="name" value="" class="form-control" >
                                        </div>
                                        <div class="form-group">
                                            <strong>Kode Kelas:</strong>
                                            <input type="text" name="code" value="" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                    </div>
                                </div>
                        
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
@endpush