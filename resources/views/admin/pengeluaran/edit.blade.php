@extends('layouts.master')

@section('addJavascript')
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
                    Pengeluaran {{ Str::upper(Auth::user()->role) }}
                </h3>
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="{{ route('daftarPembelian') }}">Pengeluaran</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <span>Edit Pengeluaran Restoran</span>
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
                            <h4 class="card-title">Detail Pengeluaran Restoran</h4><br>
                            <form method="POST"
                                action="{{ route('updatePengeluaran', ['id' => $tbl_pengeluarans->id_pengeluaran]) }}"
                                class="forms-sample">
                                @csrf
                                <div class="form-group">
                                    <label>JENIS PENGELUARAN</label>
                                    <select name="jenis" class="form-control text-center"
                                        value="{{ $tbl_pengeluarans->jenis }}">
                                        <option value="none">-- Pilih jenis Pengeluaran --</option>
                                        <option value="listrik"
                                            {{ $tbl_pengeluarans->jenis == 'listrik' ? 'selected' : '' }}>
                                            Listrik</option>
                                        <option value="operasional"
                                            {{ $tbl_pengeluarans->jenis == 'operasional' ? 'selected' : '' }}>Operasional
                                        </option>
                                        <option value="gaji pegawai"
                                            {{ $tbl_pengeluarans->jenis == 'gaji pegawai' ? 'selected' : '' }}>
                                            Gaji Pegawai</option>
                                        <option value="lain_lain"
                                            {{ $tbl_pengeluarans->jenis == 'lain_lain' ? 'selected' : '' }}>
                                            Lain Lain</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                    <textarea name="deskripsi" id="deskripsi" rows="3" class="form-control" required="required"
                                        placeholder="Masukkan deskripsi Pengeluaran">{{ $tbl_pengeluarans->deskripsi }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Total Nominal</label>
                                    <input type="int" class="form-control" placeholder="Total Nominal Pengeluaran"
                                        name="total" value="{{ $tbl_pengeluarans->total }}">
                                </div>

                                <button type="submit"
                                    href="{{ route('updatePengeluaran', ['id' => $tbl_pengeluarans->id_pembelian]) }}"
                                    class="btn btn-gradient-primary me-2">Submit</button>
                                <a href="{{ route('daftarPengeluaran') }}" class="btn btn-light">Cancel</a>
                            </form>
                        </div>
                    </div>

                </div>
                {{-- table --}}
            </div>
        </div>
    </div>
@endsection
