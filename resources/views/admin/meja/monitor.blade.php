@extends('layouts.master')

@section('addCss')
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sweetalert.min.css') }}">
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

    {{-- <!-- Pastikan jQuery sudah dimuat sebelum script ini -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.btn-update-status').on('click', function() {
                var form = $(this).closest('form');
                var pesananId = form.data('pesanan-id');
                var statusPesanan = form.find('.update-status').val();

                $.ajax({
                    type: 'POST',
                    url: '/admin/Pesanan/' + pesananId + '/update', // Sesuaikan dengan route Anda
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                        'status': statusPesanan
                    },
                    success: function(data) {
                        // Update tampilan secara real-time jika perlu
                        $('#pesanan_' + pesananId).find('.status_pesanan').text(statusPesanan);
                        // Tambahkan kode lain sesuai kebutuhan
                        console.log('Status Pesanan berhasil diperbarui');
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script> --}}
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
            {{-- content header --}}

            {{-- tabel --}}
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title text-center">Monitor Meja</h4>
                            <div class="table-responsive">
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <th>No Meja</th>
                                            <th>Kapasitas</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($mejas as $meja)
                                            <tr>
                                                <td>{{ $meja->no_meja }}</td>
                                                <td>{{ $meja->kapasitas }}</td>
                                                <td>
                                                    {{-- Tambahkan kelas warna berdasarkan status_pesanan --}}
                                                    @if ($meja->status == 'tidak tersedia')
                                                        <span class="badge badge-danger">{{ $meja->status }}</span>
                                                    @elseif ($meja->status == 'tersedia')
                                                        <span class="badge badge-success">{{ $meja->status }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <form class="update-form" method="POST"
                                                        data-meja-id="{{ $meja->id }}"
                                                        action="{{ route('updateMejam', ['id' => $meja->id]) }}">
                                                        @csrf
                                                        {{-- @method('patch') --}}
                                                        <input type="hidden" value="{{ $meja->id }}">
                                                        <select name="status" class="form-control update-status"
                                                            data-original-value="{{ $meja->status }}">
                                                            <option value="tidak tersedia"
                                                                {{ $meja->status == 'tidak tersedia' ? 'selected' : '' }}>
                                                                tidak tersedia</option>
                                                            <option value="tersedia"
                                                                {{ $meja->status == 'tersedia' ? 'selected' : '' }}>
                                                                tersedia</option>
                                                        </select>
                                                        <button type="submit"
                                                            class="btn btn-sm btn-primary btn-update-status">Update</button>
                                                    </form>
                                                </td>
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse
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
