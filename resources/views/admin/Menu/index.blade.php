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
                    <a href="{{ route('createMenu') }}" class="btn btn-outline-info btn-fw" style="margin-bottom: 10px;"
                        role="button">Tambah Menu</a>
                    <div class="table-responsive">
                        <table class="table table-hover" id="data-table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Menu</th>
                                    <th>Nama Menu</th>
                                    <th>Deskripsi</th>
                                    <th>Harga</th>
                                    <th>Total Item</th>
                                    <th>Total Transaksi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($menus as $menu)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td><img src="{{ asset($menu->foto) }}" alt="{{ $menu->menu }}"
                                                style="width: 150px; height: 100px;"></td>

                                        <td>{{ $menu->menu }}</td>
                                        <td>{{ $menu->deskripsi }}</td>
                                        {{-- <td>{{ $menu->harga }}</td> --}}
                                        <td>{{ number_format($menu->harga, 0, ',', '.') }}</td>
                                        <td>{{ $menu->total_item }}</td>
                                        {{-- <td>{{ $menu->total_transaksi }}</td> --}}
                                        <td>{{ number_format($menu->total_transaksi, 0, ',', '.') }}</td>
                                        <td>
                                            <a href="{{ route('editMenu', ['id' => $menu->id]) }}"
                                                class="btn btn-gradient-warning btn-sm" role="button">Edit</a>
                                            <a onclick="confirmDelete(this)"
                                                data-url="{{ route('deleteMenu', ['id' => $menu->id]) }}"
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
@endsection
