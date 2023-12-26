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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('.btn-pesanan-detail').on('click', function() {
                const pesananId = $(this).data('pesanan-id');
                const modalBody = $('#pesananDetailModalBody_' + pesananId);
                modalBody.html($('#pesananDetailContent_' + pesananId).html());
                $('#pesananDetailModal_' + pesananId).modal('show');
            });

            $('[id^=pesananDetailModal]').on('hidden.bs.modal', function() {
                $('[id^=pesananDetailModalBody]').html('');
            });
        });
    </script>
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
                                            {{-- <th>Menu yang dipesan</th>
                                            <th>Meja</th>
                                            <th>Total yang dipesan</th>
                                            <th>Total Pembayaran</th> --}}
                                            <th>Aksi</th>
                                            <th>Aksi</th>
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
                                                {{-- <td>
                                                    @foreach (json_decode($pesanan->menu_items) as $menuId)
                                                        {{ App\Menu::find($menuId)->menu }}
                                                        <br>
                                                    @endforeach
                                                </td>
                                                <td>{{ $pesanan->meja->no_meja }}</td>
                                                <td>{{ $pesanan->total_items }}</td>
                                                <td>{{ number_format($pesanan->total_nominal, 0, ',', '.') }}</td> --}}
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
                                                            class="btn btn-sm btn-primary btn-update-status">Perbarui</button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-primary btn-pesanan-detail"
                                                        data-pesanan-id="{{ $pesanan->id }}">
                                                        Detail Pesanan
                                                    </button>
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
            @foreach ($pesanans as $pesanan)
                <div class="modal fade" id="pesananDetailModal_{{ $pesanan->id }}" tabindex="-1"
                    aria-labelledby="pesananDetailModalLabel_{{ $pesanan->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="pesananDetailModalLabel_{{ $pesanan->id }}">
                                    Detail Pesanan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" id="pesananDetailModalBody_{{ $pesanan->id }}">
                                <!-- Content of the modal directly rendered using Blade template -->
                                <h5>Kode Invoice :{{ $pesanan->kode_invoice }}</h5>
                                <p>Nama Pelanggan :{{ $pesanan->nama_pelanggan }}</p>
                                <p>Status Pembayaran :{{ $pesanan->status_pembayaran }}</p>
                                <p>Status Pesanan :{{ $pesanan->status_pesanan }}</p>

                                <p>Menu yang dipesan :</p>
                                <ul>
                                    @foreach (json_decode($pesanan->menu_items) as $menuId)
                                        <li>{{ App\Menu::find($menuId)->menu }}</li>
                                    @endforeach
                                </ul>

                                <p>Meja :{{ $pesanan->meja->no_meja }}</p>
                                <p>Total yang dipesan :{{ $pesanan->total_items }}</p>
                                <p>Total Pembayaran :{{ number_format($pesanan->total_nominal, 0, ',', '.') }}</p>
                                <!-- ... (other details) ... -->
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
            @foreach ($pesanans as $pesanan)
                <div id="pesananDetailContent_{{ $pesanan->id }}" style="display: none;">
                    <h5>Kode Invoice : {{ $pesanan->kode_invoice }}</h5>
                    <p>Nama Pelanggan : {{ $pesanan->nama_pelanggan }}</p>
                    <p>Status Pembayaran : {{ $pesanan->status_pembayaran }}</p>
                    <p>Status Pesanan : {{ $pesanan->status_pesanan }}</p>

                    <p>Menu yang dipesan :</p>
                    <ul>
                        @foreach (json_decode($pesanan->menu_items) as $menuId)
                            <li>{{ App\Menu::find($menuId)->menu }}</li>
                        @endforeach
                    </ul>

                    <p>Meja : {{ $pesanan->meja->no_meja }}</p>
                    <p>Total yang dipesan : {{ $pesanan->total_items }}</p>
                    <p>Total Pembayaran : {{ number_format($pesanan->total_nominal, 0, ',', '.') }}</p>
                    <!-- ... (other details) ... -->
                </div>
            @endforeach
            {{-- table --}}
        </div>
    </div>
@endsection
