@extends('layouts.master')

@section('addCss')
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sweetalert.min.css') }}">
@endsection

@section('addJavascript')
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script>
        $(function() {
            $("#data-table").DataTable();
        });


        confirmDelete = function(button) {
            var url = $(button).data('url');
            swal({
                'title': 'Konfirmasi Hapus',
                'text': 'Apakah kamu yakin ingin menghapus ?',
                'dangermode': true,
                'buttons': true
            }).then(function(value) {
                if (value) {
                    window.location = url;
                }
            })
        }
    </script>
@endsection

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            {{-- content header --}}
            <div class="page-header">
                <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="mdi mdi-currency-usd"></i>
                    </span>
                    Laporan Transaksi {{ Str::upper(Auth::user()->role) }}
                </h3>
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="{{ route('daftarPembelian') }}">Laporan Transaksi</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <span>List Laporan Transaksi</span>
                        </li>
                    </ul>
                </nav>
            </div>
            {{-- content header --}}

            {{-- tabel --}}
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">

                        <div class="card-body">
                            <table class="table text-center">
                                <thead>
                                    <tr>
                                        <th>Bulan</th>
                                        <th>Nominal Transaksi Masuk</th>
                                        <th>Nominal Transaksi Keluar</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($totalNominalPesanans as $totalNominalPesanan)
                                        <tr>
                                            <td>{{ strftime('%B %Y', strtotime($totalNominalPesanan->month)) }}</td>

                                            @php
                                                $matchingPengeluaran = $totalNominalPengeluarans->firstWhere('month', $totalNominalPesanan->month);
                                                $matchingPembelian = $totalNominalPembelians->firstWhere('month', $totalNominalPesanan->month);
                                                $nominalKeluar = ($matchingPengeluaran ? $matchingPengeluaran->total_nominal : 0) + ($matchingPembelian ? $matchingPembelian->total_nominal : 0);
                                            @endphp

                                            <td>{{ $totalNominalPesanan->total_nominal }}</td>
                                            <td>{{ $nominalKeluar }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


            {{-- table --}}
        </div>
    </div>
@endsection
