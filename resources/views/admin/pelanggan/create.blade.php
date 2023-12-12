@extends('layouts.master')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            {{-- Content header --}}
            <!-- ... (unchanged) ... -->

            {{-- Form --}}
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Tambah Pelanggan </h4><br>
                            <form method="POST" action="{{ route('storePelanggan') }}" class="forms-sample" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="menuName">Nama Pelanggan</label><br>
                                    <input type="text" name="nama_pelanggan" class="form-control" id="menuName" placeholder="Masukkan Nama Menu">
                                </div>

                                <div class="form-group">
                                    <label for="description">Email</label>
                                    <textarea name="email" class="form-control" id="description" rows="3"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="terakhirKunjungan">Terakhir Kunjungan</label>
                                    <input type="text" name="terakhir_kunjungan" class="form-control" id="terakhirKunjungan" placeholder="Masukkan tanggal terakhir kunjungan">
                                </div>

                                <div class="form-group">
                                    <label for="txtTotalNominal">Total Transaksi</label>
                                    <input type="text" name="total_transaksi" class="form-control" id="txtTotalNominal" readonly>
                                </div>

                                <button type="submit" class="btn btn-gradient-primary me-2">Simpan</button>
                                <a href="{{ route('daftarPelanggan') }}" class="btn btn-light">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Form --}}
        </div>
    </div>
@endsection
