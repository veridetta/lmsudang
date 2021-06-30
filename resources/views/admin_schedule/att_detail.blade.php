@extends('layouts.app')

@section('content')
    @include('layouts.headers.general')
    
    <div class="container-fluid mt--7" id="app">
    <div class="container">
    <div class="row justify-content-center">
    <div class="col-xl-12 mb-5 mb-xl-0">
                        <div class="card bg-gradient-default shadow">
                            <div class="card-header bg-transparent">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="text-uppercase text-light ls-1 mb-1">Overview</h6>
                                        <h2 class="text-white mb-0">Grafik Kehadiran</h2>
                                    </div>
                                    <div class="col">
                                        <ul class="nav nav-pills justify-content-end">
                                            <li class="nav-item mr-2 mr-md-0" data-toggle="chart" data-target="#chart-sales" data-update='{"data":{"labels": ["Pertemuan 1","Pertemuan 2","Pertemuan 3","Pertemuan 4","Pertemuan 5", "Pertemuan 6", "Pertemuan 7","Pertemuan 8","Pertemuan 9"],"datasets":[{"data":[0, 20, 10, 30, 15, 40, 20, 60, 60]}]}}' data-prefix="" data-suffix="">
                                                <a href="#" class="nav-link py-2 px-3 active" data-toggle="tab">
                                                    <span class="d-none d-md-block">Month</span>
                                                    <span class="d-md-none">D</span>
                                                </a>
                                            </li>
                                            <li class="nav-item" data-toggle="chart" data-target="#chart-sales" data-update='{"data":{"datasets":[{"data":[0, 20, 5, 25, 10, 30, 15, 40, 40]}]}}' data-prefix="$" data-suffix="k">
                                                <a href="#" class="nav-link py-2 px-3" data-toggle="tab">
                                                    <span class="d-none d-md-block">Week</span>
                                                    <span class="d-md-none">W</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- Chart -->
                                <div class="chart">
                                    <!-- Chart wrapper -->
                                    <canvas id="chart-att" class="chart-canvas"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                <div class="card-header">{{ __('Grafik Kehadiran') }}</div>

                <div class="card-body">
                   
            </div>
        </div>
    </div>
</div>
        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
    <script src="{{mix('js/app.js')}}"></script>
<script>
var gr_att = $('#chart-att');
var att_chart=new Chart(gr_att,{
    type:"bar",
    data:{
        labels : ["Pertemuan 1","Pertemuan 2","Pertemuan 3","Pertemuan 4","Pertemuan 5", "Pertemuan 6", "Pertemuan 7","Pertemuan 8","Pertemuan 9"],
        datasets:[{
            label : "Hadir",
            fillColor : "green",
            data:[0, 20, 10, 30, 15, 40, 20, 60, 60]
            },{
            label : "Ijin",
            fillColor : "yellow",
            data:[0, 10, 10, 30, 15, 40, 20, 60, 60]
            },{
            label : "Sakit",
            fillColor : "orange",
            data:[0, 50, 10, 30, 15, 40, 20, 60, 60]
            }]
    }
})
</script>
@endpush