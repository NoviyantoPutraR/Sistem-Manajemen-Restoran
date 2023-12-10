@extends('layouts.master')

@section('addJavascript')
    <script>
        function updateTotal() {
            var kategori = document.getElementById('txtKategori').value;
            var totalItem = parseFloat(document.getElementById('txtTotalItem').value) || 0;

            // Logika untuk menghitung total nominal berdasarkan kategori dan total item
            var hargaPerItem = getHargaPerItem(kategori);
            var totalNominal = totalItem * hargaPerItem;

            // Format totalNominal ke dalam format rupiah dengan titik sebagai pemisah ribuan
            var formattedNominal = formatRupiah(totalNominal);

            document.getElementById('txtTotalNominal').value = formattedNominal;
        }

        // Panggil fungsi updateTotal untuk menginisiasi perhitungan dan pemformatan
        updateTotal();

        function getHargaPerItem(kategori) {
            // Ganti dengan logika atau database untuk mendapatkan harga per item berdasarkan kategori
            switch (kategori) {
                case 'Daging':
                    return 100000; // Harga per kilogram
                case 'Seafood':
                    return 50000; // Harga per kilogram 
                case 'Karbo':
                    return 25000;
                case 'Sayur':
                    return 20000;
                case 'Buah':
                    return 18000;
                case 'Bumbu':
                    return 10000;
                case 'Tepung':
                    return 14000;
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

            // Tambahkan titik sebagai pemisah ribuan
            rupiah = rupiah.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

            return prefix === undefined ? rupiah : rupiah ? +rupiah : '';
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
                            <span>Edit Pembelian Bahan Baku</span>
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
                            <form method="POST"
                                action="{{ route('updatePembelian', ['id' => $tbl_pembelians->id_pembelian]) }}"
                                class="forms-sample">
                                @csrf
                                <div class="form-group">
                                    <label for="txtKategori">KATEGORI</label>
                                    <select name="kategori" class="form-control text-center" id="txtKategori"
                                        onchange="updateTotal()" value="{{ $tbl_pembelians->kategori }}">
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
                                    <label for="txtTotalNominal">TOTAL NOMINAL (Rp)</label>
                                    <input name="total" type="double" class="form-control" id="txtTotalNominal" readonly
                                        value="{{ $tbl_pembelians->total }}">
                                </div>

                                <button type="submit"
                                    href="{{ route('updatePembelian', ['id' => $tbl_pembelians->id_pembelian]) }}"
                                    class="btn btn-gradient-primary me-2">Submit</button>
                                <a href="{{ route('daftarPembelian') }}" class="btn btn-light">Cancel</a>
                            </form>
                        </div>
                    </div>

                </div>
                {{-- table --}}
            </div>
        </div>
    </div>
@endsection
