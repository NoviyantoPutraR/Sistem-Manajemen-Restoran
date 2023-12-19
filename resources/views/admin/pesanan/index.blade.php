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
                        'status_pesanan': statusPesanan
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
                        <i class="mdi mdi-food-fork-drink menu-icon"></i>
                    </span>
                    Pesanan {{ Str::upper(Auth::user()->role) }}
                </h3>
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="{{ route('daftarPesanan') }}">Pesanan</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <span>List Pemesanan</span>
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
                            <a href="{{ route('createPesanan') }}" class="btn btn-outline-info btn-fw"
                                style="margin-bottom: 10px;" role="button">Tambah Pesanan</a>
                            <h4 class="card-title text-center">Daftar Pemesanan</h4>
                            <div class="table-responsive">
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <th>Kode Invoice</th>
                                            <th>Nama Pelanggan</th>
                                            <th>Status Pembayaran</th>
                                            <th>Status Pesanan</th>
                                            <th>Menu</th>
                                            <th>Meja</th>
                                            <th>Total Yg dipesan</th>
                                            <th>Total Pembayaran</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($pesanans as $pesanan)
                                            <tr>
                                                <td>{{ $pesanan->kode_invoice }}</td>
                                                <td>{{ $pesanan->nama_pelanggan }}</td>
                                                {{-- <td>{{ $pesanan->status_pembayaran }}</td> --}}
                                                <td>
                                                    {{-- Tambahkan kelas warna berdasarkan status_pesanan --}}
                                                    @if ($pesanan->status_pembayaran == 'lunas')
                                                        <span
                                                            class="badge badge-success">{{ $pesanan->status_pembayaran }}</span>
                                                    @elseif ($pesanan->status_pembayaran == 'belum lunas')
                                                        <span
                                                            class="badge badge-danger">{{ $pesanan->status_pembayaran }}</span>
                                                    @endif
                                                </td>
                                                {{-- <td>{{ $pesanan->status_pesanan }}</td> --}}
                                                <td>
                                                    {{-- Tambahkan kelas warna berdasarkan status_pesanan --}}
                                                    @if ($pesanan->status_pesanan == 'belum diproses')
                                                        <span
                                                            class="badge badge-danger">{{ $pesanan->status_pesanan }}</span>
                                                    @elseif ($pesanan->status_pesanan == 'sedang diproses')
                                                        <span
                                                            class="badge badge-warning">{{ $pesanan->status_pesanan }}</span>
                                                    @elseif ($pesanan->status_pesanan == 'selesai')
                                                        <span
                                                            class="badge badge-success">{{ $pesanan->status_pesanan }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ $pesanan->menu->menu }}</td>
                                                <td>{{ $pesanan->meja->no_meja }}</td>
                                                <td>{{ $pesanan->total_items }}</td>
                                                <td>{{ $pesanan->total_nominal }}</td>
                                                <td>
                                                    <form class="update-form" method="POST"
                                                        data-pesanan-id="{{ $pesanan->id }}"
                                                        action="{{ route('updatePesanan', ['pesanan' => $pesanan->id]) }}">
                                                        @csrf
                                                        {{-- @method('patch') --}}
                                                        <input type="hidden" name="pesanan_id"
                                                            value="{{ $pesanan->id }}">
                                                        <select name="status_pesanan" class="form-control update-status"
                                                            data-original-value="{{ $pesanan->status_pesanan }}">
                                                            <option value="belum diproses"
                                                                {{ $pesanan->status_pesanan == 'belum diproses' ? 'selected' : '' }}>
                                                                Belum Diproses</option>
                                                            <option value="sedang diproses"
                                                                {{ $pesanan->status_pesanan == 'sedang diproses' ? 'selected' : '' }}>
                                                                Sedang Diproses</option>
                                                            <option value="selesai"
                                                                {{ $pesanan->status_pesanan == 'selesai' ? 'selected' : '' }}>
                                                                Selesai</option>
                                                        </select>
                                                        <button type="submit"
                                                            class="btn btn-sm btn-primary btn-update-status">Update</button>
                                                    </form>
                                                </td>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7">Tidak ada pesanan dine in.</td>
                                            </tr>
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
