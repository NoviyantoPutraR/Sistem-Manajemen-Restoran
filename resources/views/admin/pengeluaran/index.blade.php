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
                    Pengeluaran {{ Str::upper(Auth::user()->role) }}
                </h3>
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="{{ route('daftarPembelian') }}">Pengeluaran</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <span>List Pengeluaran Resto</span>
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
                            <a href="{{ route('addPengeluaran') }}" class="btn btn-outline-info btn-fw"
                                style="margin-bottom: 10px;" role="button">Tambah Pengeluaran</a>
                            <h4 class="card-title text-center">Daftar Pengeluaran Resto</h4>
                            <div class="table-responsive">
                                <table class="table table-hover table-striped text-center" id="data-table">
                                    <thead>
                                        <tr>
                                            <th>Id Pengeluaran</th>
                                            <th>Jenis</th>
                                            <th>Deskripsi</th>
                                            <th>Total Nominal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tbl_pengeluarans as $pengeluaran)
                                            <tr>
                                                <td>{{ $pengeluaran->id_pengeluaran }}</td>
                                                <td>{{ $pengeluaran->jenis }}</td>
                                                <td>{{ $pengeluaran->deskripsi }}</td>
                                                <td>{{ number_format($pengeluaran->total, 0, ',', '.') }}</td>
                                                </td>
                                                <td>
                                                    <a href="{{ route('editPengeluaran', ['id' => $pengeluaran->id_pengeluaran]) }}"
                                                        class="btn btn-gradient-warning btn-sm" role="button">Edit</a>
                                                    <a onclick="confirmDelete(this)"
                                                        data-url="{{ route('deletePengeluaran', ['id' => $pengeluaran->id_pengeluaran]) }}"
                                                        class="btn btn-gradient-danger btn-sm" role="button">Hapus</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- table --}}
        </div>
    </div>
@endsection
