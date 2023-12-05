@extends('layouts.master')

@section('addJavascript')
    <script>
        function updateTotal() {
            var kategori = document.getElementById('txtKategori').value;
            var totalItem = parseFloat(document.getElementById('txtTotalItem').value) || 0;

            // Logika untuk menghitung total nominal berdasarkan kategori dan total item
            var hargaPerItem = getHargaPerItem(kategori); // Ganti dengan fungsi atau nilai harga per item yang sesuai
            var totalNominal = totalItem * hargaPerItem;

            // Format totalNominal ke dalam format rupiah
            var formattedNominal = formatRupiah(totalNominal, 'Rp ');

            document.getElementById('txtTotalNominal').value = formattedNominal;
        }

        function getHargaPerItem(kategori) {
            // Ganti dengan logika atau database untuk mendapatkan harga per item berdasarkan kategori
            switch (kategori) {
                case 'Daging':
                    return 15000; // Harga per kilogram
                case 'Seafood':
                    return 20000; // Harga per kilogram
                    // ... tambahkan kategori lainnya sesuai kebutuhan
                default:
                    return 0;
            }
        }

        function formatRupiah(angka, prefix) {
            var number_string = angka.toString().replace(/[^,\d]/g, '');
            var split = number_string.split(',');
            var sisa = split[0].length % 3;
            var rupiah = split[0].substr(0, sisa);
            var ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix === undefined ? rupiah : rupiah ? 'Rp ' + rupiah : '';
        }
    </script>
@endsection

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            {{-- content header --}}
            <div class="page-header">
                <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="mdi mdi-home"></i>
                    </span>
                    Pengeluaran {{ Str::upper(Auth::user()->role) }}
                </h3>
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="{{ route('daftarPembelian') }}">Pengeluaran</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <span>Tambah Pembelian Bahan Baku</span>
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
                            <h4 class="card-title">Detail Pembelian Bahan Baku</h4><br>
                            <form method="POST" action="{{ route('storePembelian') }}" class="forms-sample">
                                @csrf
                                <div class="form-group">
                                    <label for="txtKategori">KATEGORI</label>
                                    <select name="kategori" class="form-control text-center" id="txtKategori"
                                        onchange="updateTotal()">
                                        <option value="none">-- Pilih kategori --</option>
                                        <option value="Daging">Daging</option>
                                        <option value="Seafood">Seafood</option>
                                        <option value="Karbo">Karbo</option>
                                        <option value="Sayur">Sayur</option>
                                        <option value="Buah">Buah</option>
                                        <option value="Bumbu">Bumbu</option>
                                        <option value="Tepung">Tepung</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="txtTotalItem">TOTAL ITEM</label>
                                    <input type="int" class="form-control" id="txtTotalItem"
                                        placeholder="Total Pembelian Item" onchange="updateTotal()">
                                </div>

                                <div class="form-group">
                                    <label for="txtTotalNominal">TOTAL NOMINAL</label>
                                    <input name="total" type="int" class="form-control" id="txtTotalNominal" readonly>
                                </div>

                                <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                                <button href="{{ route('daftarPembelian') }}" class="btn btn-light">Cancel</button>
                            </form>
                        </div>
                    </div>

                </div>
                {{-- table --}}
            </div>
        </div>
    </div>
@endsection
