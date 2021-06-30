@extends('layouts.app')
@section('content')
@include('layouts.headers.general')
    <div class="container-fluid mt--8" id="app">
        <div class="row mt-5">
            <div class="row col-12 justify-content-center">
                <div class="col-md-6 col-12">
                    <div class="card ">
                        <div class="card-header">{{ __('Ubah Siswa') }}</div>
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
                                        <a class="btn btn-secondary" href="{{ route('admin_student.index') }}"> Back</a>
                                    </div>
                                </div>
                            </div>
                        
                            <form action="{{ route('admin_student.update',$students->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="id" value="{{ $students->id }}">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Nama:</strong>
                                            <input type="text" name="name" value="{{ $students->name }}" class="form-control" >
                                        </div>
                                        <div class="form-group">
                                            <strong>NIS:</strong>
                                            <input type="number" name="nis" value="{{ $students->nis }}" class="form-control" >
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>Kelas:</strong>
                                                <select name="grade_code" class="custom-select form-control">
                                                    <option selected>Pilih...</option>
                                                @foreach ($grades as $grade)
                                                    <option value="{{$grade->code}}">{{$grade->name}}
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Alamat:</strong>
                                            <textarea name="address" class="form-control">{{$students->address}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Telp:</strong>
                                            <input type="text" name="hp" class="form-control" placeholder="Telp" value="{{ $students->hp }}" >
                                        </div>
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