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

        function confirmDelete(button) {
            var url = $(button).data('url');
            swal({
                title: 'Konfirmasi Hapus',
                text: 'Apakah Kamu Yakin Ingin Menghapus Data Ini?',
                dangermode: true,
                buttons: true,
            }).then(function(value) {
                if (value) {
                    window.location = url;
                }
            });
        }
    </script>
@endsection

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-food"></i>
                </span>
                Menu
            </h3>
        </div>

        <div class="card">
            <div class="card-body">
                <a href="{{ route('createPelanggan') }}" class="btn btn-outline-info btn-fw" style="margin-bottom: 10px;" role="button">Tambah Pelanggan</a>
                <div class="table-responsive">
                    <table class="table table-hover" id="data-table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Pelanggan</th>
                                <th>Email</th>
                                <th>Terakhir Kunjungan</th>
                                <th>Total Transaksi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pelanggans as $pelanggan)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $pelanggan->nama_pelanggan }}</td>
                                    <td>{{ $pelanggan->email }}</td>
                                    <td>{{ $pelanggan->terakhir_kunjungan }}</td>
                                    <td>{{ $pelanggan->total_transaksi }}</td>
                                    <td>
                                        <a href="{{ route('editPelanggan', ['id' => $pelanggan->id]) }}" class="btn btn-gradient-warning btn-sm" role="button">Edit</a>
                                        <a onclick="confirmDelete(this)" data-url="{{ route('deletePelanggan', ['id' => $pelanggan->id])}}" class="btn btn-gradient-danger btn-sm" role="button">Hapus</a>
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
@endsection
