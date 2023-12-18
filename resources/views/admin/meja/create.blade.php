@extends('layouts.master')

@section('addCss')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@endsection

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="mdi mdi-food"></i>
                    </span>
                    List Meja
                </h3>
            </div>
            {{-- Content header --}}
            <!-- ... (unchanged) ... -->

            {{-- Form --}}
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Tambah Meja</h4><br>
                            <form method="POST" action="{{ route('storeMeja') }}" class="forms-sample"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="kapasitasMeja">No Meja</label><br>
                                    <input type="int" name="no_meja" class="form-control" id="no_meja"
                                        placeholder="Masukkan No Meja">
                                </div>

                                <div class="form-group">
                                    <label for="kapasitasMeja">Kapasitas Meja</label><br>
                                    <input type="text" name="kapasitas" class="form-control" id="kapasitasMeja"
                                        placeholder="Masukkan Kapasitas Meja">
                                </div>

                                <div class="form-group">
                                    <label for="statusMeja">Status</label>
                                    <select name="status" class="form-control" id="statusMeja">
                                        <option value="NotAvailable">Not Available</option>
                                        <option value="Availabe">Available</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="terakhirKunjungan">Terakhir Kunjungan</label>
                                    <input type="date" name="terakhir_kunjungan" class="form-control datepicker"
                                        id="terakhirKunjungan" placeholder="Masukkan tanggal terakhir kunjungan">
                                </div>

                                <button type="submit" class="btn btn-gradient-primary me-2">Simpan</button>
                                <a href="{{ route('daftarMeja') }}" class="btn btn-light">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Form --}}
        </div>
    </div>
@endsection
