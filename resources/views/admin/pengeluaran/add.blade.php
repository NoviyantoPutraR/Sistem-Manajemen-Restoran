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
                            <a href="{{ route('daftarPengeluaran') }}">Pengeluaran</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <span>Tambah Pengeluaran Resto</span>
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
                            <h4 class="card-title">Detail Pengeluaran Resto</h4><br>
                            <form method="POST" action="{{ route('storePengeluaran') }}" class="forms-sample">
                                @csrf
                                <div class="form-group">
                                    <label>JENIS PENGELUARAN</label>
                                    <select name="jenis" class="form-control text-center">
                                        <option value="none">-- Pilih Jenis Pengeluaran --</option>
                                        <option value="listrik">Listrik</option>
                                        <option value="operasional">Operasional</option>
                                        <option value="gaji pegawai">Gaji Pegawai</option>
                                        <option value="lain_lain">Lain Lain</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                    <textarea name="deskripsi" id="deskripsi" rows="3" class="form-control" required="required"
                                        placeholder="Masukkan deskripsi Pengeluaran"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Total Nominal</label>
                                    <input type="int" class="form-control" placeholder="Total Nominal Pengeluaran"
                                        name="total">
                                </div>

                                <button type="submit" href="{{ route('storePengeluaran') }}"
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
