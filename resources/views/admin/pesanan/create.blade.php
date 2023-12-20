@extends('layouts.master')

@section('addJavascript')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            var totalItemsInput = document.getElementById('total_items');
            var totalNominalInput = document.getElementById('total_nominal');

            checkboxes.forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    calculateTotal();
                });
            });

            function calculateTotal() {
                var totalItems = 0;
                var totalNominal = 0;

                checkboxes.forEach(function(checkbox) {
                    if (checkbox.checked) {
                        var hargaMenu = parseFloat(checkbox.getAttribute('data-harga'));
                        totalItems++;
                        totalNominal += hargaMenu;
                    }
                });

                totalItemsInput.value = totalItems;
                totalNominalInput.value = totalNominal;
            }
        });
    </script>
@endsection

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            {{-- Content header --}}
            <div class="page-header">
                <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="mdi mdi-clipboard-text menu-icon"></i>
                    </span>
                    Pesanan {{ Str::upper(Auth::user()->role) }}
                </h3>
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="{{ route('daftarPesanan') }}">Pesanan</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <span>Tambah Pesanan</span>
                        </li>
                    </ul>
                </nav>
            </div>
            {{-- Content header --}}

            {{-- Form --}}
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Tambah Menu</h4><br>
                            <form method="POST" action="{{ route('createPesanan') }}" class="forms-sample"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="invoice_code">Pesanan Ke :</label>
                                    <input type="text" name="kode_invoice" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="customer_name">Nama Pelanggan:</label>
                                    <input type="text" name="nama_pelanggan" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="menu_id">Pilih Menu:</label>
                                    @foreach ($menus as $menu)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="menu_id[]"
                                                value="{{ $menu->id }}" data-harga="{{ $menu->harga }}">
                                            <label class="form-check-label">{{ $menu->menu }} -
                                                {{ $menu->harga }}</label>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="form-group">
                                    <label for="meja_id">Pilih Meja</label>
                                    <select name="meja_id" class="form-control" required>
                                        @foreach ($mejas as $meja)
                                            <option value="{{ $meja->id }}">{{ $meja->no_meja }} - Kapasitas:
                                                {{ $meja->kapasitas }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="status_pembayaran">Status Pembayaran:</label>
                                    <select name="status_pembayaran" class="form-control" required>
                                        <option value="lunas">Lunas</option>
                                        <option value="belum lunas">Belum Lunas</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="status_pesanan">Status Pesanan:</label>
                                    <select name="status_pesanan" class="form-control" required>
                                        <option value="belum diproses">Belum Diproses</option>
                                        <option value="sedang diproses">Sedang Diproses</option>
                                        <option value="selesai">Selesai</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="total_items">Total Menu yang dipesan:</label>
                                    <input type="number" name="total_items" id="total_items" class="form-control" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="total_nominal">Total harga:</label>
                                    <input type="number" name="total_nominal" id="total_nominal" class="form-control"
                                        step="0.01" readonly>
                                </div>

                                <button type="submit" class="btn btn-gradient-primary me-2">Simpan</button>
                                <a href="{{ route('daftarMenu') }}" class="btn btn-light">Batal</a>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            {{-- Form --}}
        </div>
    </div>
@endsection
