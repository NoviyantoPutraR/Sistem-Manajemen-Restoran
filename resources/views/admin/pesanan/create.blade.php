@extends('layouts.master')

@section('addJavascript')
@endsection

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            {{-- Content header --}}
            <div class="page-header">
                <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="mdi mdi-home"></i>
                    </span>
                    Menu {{ Str::upper(Auth::user()->role) }}
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
                            <h4 class="card-title">Tambah Menu </h4><br>
                            <form method="POST" action="#" class="forms-sample" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="invoice_code">Pesanan Ke :</label>
                                    <input type="text" name="kode_invoice" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="customer_name">Customer Name:</label>
                                    <input type="text" name="nama_pelanggan" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="menu_id">Menu:</label>
                                    <select name="menu_id" class="form-control" required>
                                        @foreach ($menus as $menu)
                                            <option value="{{ $menu->id }}">{{ $menu->menu }} - {{ $menu->harga }}
                                            </option>
                                        @endforeach
                                    </select>
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
                                    <label for="status_pembayaran">Payment Status:</label>
                                    <select name="status_pembayaran" class="form-control" required>
                                        <option value="lunas">Lunas</option>
                                        <option value="belum lunas">Belum Lunas</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="status_pesanan">Order Status:</label>
                                    <select name="status_pesanan" class="form-control" required>
                                        <option value="belum diproses">Belum Diproses</option>
                                        <option value="sedang diproses">Sedang Diproses</option>
                                        <option value="selesai">Selesai</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="total_items">Total Menu yang dipesan:</label>
                                    <input type="number" name="total_items" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="total_nominal">Total harga:</label>
                                    <input type="number" name="total_nominal" class="form-control" step="0.01" required>
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
