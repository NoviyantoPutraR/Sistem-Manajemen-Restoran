@extends('layouts.master')

@section('addCss')
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sweetalert.min.css') }}">
    <!-- Add this line to include Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
        .card {
            height: 100%;
        }

        .card-body {
            padding: 1rem;
        }

        .card-title,
        .card-text {
            margin-bottom: 0.5rem;
        }

        .card-text .badge {
            margin-right: 0.5rem;
        }
    </style>
@endsection

@section('addJavascript')
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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
            {{-- Content Header --}}
            <div class="page-header">
                <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="mdi mdi-contacts menu-icon"></i>
                    </span>
                    Monitor Meja {{ Str::upper(Auth::user()->role) }}
                </h3>
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="{{ route('daftarMejam') }}">Monitor Meja</a>
                        </li>
                    </ul>
                </nav>
            </div>
            {{-- End Content Header --}}

            {{-- Title Above Cards --}}
            <div class="row mb-3">
                <div class="col-12">
                    <h2 class="text-center">Status Meja</h2>
                </div>
            </div>

            {{-- Cards --}}
            <div class="row">
                @forelse ($mejas as $meja)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">No Meja: {{ $meja->no_meja }}</h4>
                                <p class="card-text">Kapasitas: {{ $meja->kapasitas }}</p>
                                <p class="card-text">
                                    @if ($meja->status == 'tidak tersedia')
                                        <span class="badge badge-danger"><i class="fas fa-chair"></i>
                                            {{ $meja->status }}</span>
                                    @elseif ($meja->status == 'tersedia')
                                        <span class="badge badge-success"><i class="fas fa-chair"></i>
                                            {{ $meja->status }}</span>
                                    @endif
                                </p>
                                <form class="update-form" method="POST" data-meja-id="{{ $meja->id }}"
                                    action="{{ route('updateMejam', ['id' => $meja->id]) }}">
                                    @csrf
                                    <input type="hidden" value="{{ $meja->id }}">
                                    <select name="status" class="form-control update-status"
                                        data-original-value="{{ $meja->status }}">
                                        <option value="tidak tersedia"
                                            {{ $meja->status == 'tidak tersedia' ? 'selected' : '' }}>
                                            tidak tersedia</option>
                                        <option value="tersedia" {{ $meja->status == 'tersedia' ? 'selected' : '' }}>
                                            tersedia</option>
                                    </select>
                                    <button type="submit" class="btn btn-sm btn-primary btn-update-status">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-12">
                        <p class="text-center">Tidak ada data meja</p>
                    </div>
                @endforelse
            </div>

            {{-- End Cards --}}
        </div>
    </div>
@endsection
