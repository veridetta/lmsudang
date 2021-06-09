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
                <div class="card ">
                <div class="table-responsive " >
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Kelas</th>
                                    <th scope="col">Mapel</th>
                                    <th scope="col">Pengajar</th>
                                    <th scope="col">Waktu</th>
                                    <th scope="col">Hari</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $o=1;?>
                            @foreach($sc_alls as $sc_all)
                                <tr>
                                   <td>{{$o}}</td>
                                   <td>{{$sc_all->grade->name}}</td>
                                   <td>{{$sc_all->academic->name}}</td>
                                   <td>{{$sc_all->teacher->name}}</td>
                                   <td>{{$sc_all->start}} - {{$sc->end}}</td>
                                   <td><span class="badge badge-pill badge-danger">{{$sc->day}}</span></td>
                                </tr>
                                <?php $o++;?>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $sc_alls ?? ''->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </tes>
</div>
@endsection
