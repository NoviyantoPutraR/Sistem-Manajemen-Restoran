@extends('layouts.master')

@section('addJavascript')
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script>
        confirmDelete = function(button) {
            var url = $(button).data('url');
            swal({
                'title': 'Konfirmasi Hapus',
                'text': 'Apakah kamu yakin ingin menghapus?',
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
            {{-- content header --}}

            {{-- tabel --}}
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">                            
                            <div class="table-responsive">
                                <table class="table table-hover table-striped mx-auto">                               
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>User</th>
                                            <th>Type</th>
                                            <th>Last Login</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tbl_users as $tbl_user)
                                            <tr>
                                                <td>{{ $tbl_user->id}}</td>
                                                <td>{{ $tbl_user->name }}</td>
                                                <td>{{ $tbl_user->role }}</td>
                                                <td>{{ \Carbon\Carbon::parse($tbl_user->created_at)->format('Y-m-d H:i:s') }}</td>
                                                <td>
                                                    <a href="{{ route('editUser', $tbl_user->id) }}" class="btn btn-gradient-warning btn-sm" role="button">Edit</a>
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
            {{-- table --}}
        </div>
    </div>    
@endsection
