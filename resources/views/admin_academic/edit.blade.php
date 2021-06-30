@extends('layouts.app')
@section('content')
@include('layouts.headers.general')
    <div class="container-fluid mt--8" id="app">
        <div class="row mt-5">
            <div class="row col-12 justify-content-center">
                <div class="col-md-6 col-12">
                    <div class="card ">
                        <div class="card-header">{{ __('Ubah Pelajaran') }}</div>
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
                                        <a class="btn btn-secondary" href="{{ route('admin_academic.index') }}"> Back</a>
                                    </div>
                                </div>
                            </div>
                        
                            <form action="{{ route('admin_academic.update',$academics->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="id" value="{{ $academics->id }}">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Nama Pelajaran:</strong>
                                            <input type="text" name="name" value="{{ $academics->name }}" class="form-control" >
                                        </div>
                                        <div class="form-group">
                                            <strong>Kode Pelajaran:</strong>
                                            <input type="text" name="code" value="{{ $academics->code }}" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">Update</button>
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