@extends('layouts.master')

@section('addJavascript')
    <!-- //Grafik Pengeluaran -->
    <script>
        var labels = [
            @foreach ($grafikPengeluaran as $item)
                '{{ date('F', mktime(0, 0, 0, $item->month, 1)) }}',
            @endforeach
        ];

        var data = [
            @foreach ($grafikPengeluaran as $item)
                {{ $item->total_per_month }},
            @endforeach
        ];

        var backgroundColor = [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
        ];

        var borderColor = [
            'rgba(255,99,132,1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
        ];

        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Pengeluaran Per Bulan',
                    data: data,
                    backgroundColor: backgroundColor,
                    borderColor: borderColor,
                    borderWidth: 1
                }]
            },
            options: {
                animation: {
                    duration: 1000,
                    easing: 'easeInOutQuad',
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                tooltips: {
                    enabled: true,
                    mode: 'index',
                    intersect: false,
                },
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        boxWidth: 20,
                        fontSize: 10,
                        fontColor: 'black'
                    },
                    onClick: function(e, legendItem) {
                        var index = legendItem.datasetIndex;
                        var meta = myChart.getDatasetMeta(index);
                        meta.hidden = meta.hidden === null ? !myChart.data.datasets[index].hidden : null;
                        myChart.update();
                    }
                }
            }
        });
    </script>

<!-- Grafik Pemasukan -->
<script>
        var labels = [
            @foreach ($grafikPemasukan as $item)
                '{{ date('F', mktime(0, 0, 0, $item->month, 1)) }}',
            @endforeach
        ];

        var data = [
            @foreach ($grafikPemasukan as $item)
                {{ $item->total_per_month }},
            @endforeach
        ];

        var backgroundColor = [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
        ];

        var borderColor = [
            'rgba(255,99,132,1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
        ];

        var ctx1 = document.getElementById("myChart1").getContext('2d');
        var myChart1 = new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Pengeluaran Per Bulan',
                    data: data,
                    backgroundColor: backgroundColor,
                    borderColor: borderColor,
                    borderWidth: 1
                }]
            },
            options: {
                animation: {
                    duration: 1000,
                    easing: 'easeInOutQuad',
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                tooltips: {
                    enabled: true,
                    mode: 'index',
                    intersect: false,
                },
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        boxWidth: 20,
                        fontSize: 10,
                        fontColor: 'black'
                    },
                    onClick: function(e, legendItem) {
                        var index = legendItem.datasetIndex;
                        var meta = myChart.getDatasetMeta(index);
                        meta.hidden = meta.hidden === null ? !myChart.data.datasets[index].hidden : null;
                        myChart.update();
                    }
                }
            }
        });
    </script>
@endsection



@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="mdi mdi-home"></i>
                    </span>
                    Dashboard {{ Str::upper(Auth::user()->role) }}
                </h3>
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">
                            <span></span>Dashboard
                            {{-- <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i> --}}
                        </li>
                    </ul>
                </nav>
            </div>

            <div class="row">
                <div class="col-md-4 stretch-card grid-margin">
                    <div class="card bg-gradient-danger card-img-holder text-white">
                        <div class="card-body">
                            <img src="{{ asset('assets/images/dashboard/circle.svg') }}" class="card-img-absolute"
                                alt="circle-image" />
                            <h4 class="font-weight-normal mb-3">Pengunjung <i
                                    class="mdi mdi-account-multiple-plus float-right"></i>
                            </h4>
                            <h2 class="font-weight-medium text-right mb-0">
                                {{ $jumlahPengunjung ?? 'belum tersedia' }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 stretch-card grid-margin">
                    <div class="card bg-gradient-info card-img-holder text-white">
                        <div class="card-body">
                            <img src="{{ asset('assets/images/dashboard/circle.svg') }}" class="card-img-absolute"
                                alt="circle-image" />
                            <h4 class="font-weight-normal mb-3">Pengeluaran <i class="mdi mdi-book-minus float-right"></i>
                            </h4>
                            <h2 class="font-weight-medium text-right mb-0">
                                @php
                                    $sumTotal = $totalPengeluaran + $totalPembelianBB;
                                @endphp

                                @isset($sumTotal)
                                    Rp {{ number_format($sumTotal, 0, ',', '.') }}
                                @else
                                    Data tidak tersedia
                                @endisset
                            </h2>

                        </div>
                    </div>
                </div>
                <div class="col-md-4 stretch-card grid-margin">
                    <div class="card bg-gradient-success card-img-holder text-white">
                        <div class="card-body">
                            <img src="{{ asset('assets/images/dashboard/circle.svg') }}" class="card-img-absolute"
                                alt="circle-image" />
                            <h4 class="font-weight-normal mb-3">Total Transaksi <i class="mdi mdi-cash-usd float-right"></i>
                            </h4>
                            <h2 class="font-weight-medium text-right mb-0">
                                @isset($totalTransaksi)
                                    Rp {{ number_format($totalTransaksi, 0, ',', '.') }}
                                @else
                                    Data tidak tersedia
                                @endisset
                            </h2>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-7 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="clearfix">
                                <h4 class="card-title float-center">
                                    Pengeluaran
                                </h4>
                                <div id="visit-sale-chart-legend"
                                    class="rounded-legend legend-horizontal legend-top-right float-right"></div>
                            </div>
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-7 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="clearfix">
                                <h4 class="card-title float-center">
                                    Pemasukan
                                </h4>
                                <div id="visit-sale-chart-legend"
                                    class="rounded-legend legend-horizontal legend-top-right float-right"></div>
                            </div>
                            <canvas id="myChart1"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
