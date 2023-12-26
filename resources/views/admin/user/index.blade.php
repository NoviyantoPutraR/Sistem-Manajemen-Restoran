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
            {{-- content header --}}
            <div class="page-header">
                <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="mdi mdi-home"></i>
                    </span>
                    Settings Resto {{ Str::upper(Auth::user()->role) }}
                </h3>
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">
                            <span></span>Settings Resto
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <span></span>List Manajemen User
                        </li>
                    </ul>
                </nav>
            </div>

            <div class="card">
                <div class="card-body">
                    <a href="{{ route('addUser') }}" class="btn btn-outline-info btn-fw" style="margin-bottom: 10px;"
                        role="button">Tambah User</a>

                    <div class="table-responsive">
                        <table class="table table-hover" id="data-table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>User</th>
                                    <th>Email</th>
                                    <th>Type</th>
                                    <th>Last Login</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tbl_users as $tbl_user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $tbl_user->name }}</td>
                                        <td>{{ $tbl_user->email }}</td>
                                        <td>{{ $tbl_user->role }}</td>
                                        <td>{{ \Carbon\Carbon::parse($tbl_user->created_at)->setTimezone('Asia/Jakarta')->translatedFormat('j M Y') }}
                                        </td>
                                        <td>
                                            <a href="{{ route('editUser', ['id' => $tbl_user->id]) }}"
                                                class="btn btn-gradient-warning btn-sm" role="button">Edit</a>
                                            <a onclick="confirmDelete(this)"
                                                data-url="{{ route('deleteUser', ['id' => $tbl_user->id]) }}"
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
