@extends('layouts.master')

@section('addJavascript')
    <script>
        function updateTotal() {
            var kategori = document.getElementById('txtKategori').value;
            var totalItem = parseFloat(document.getElementById('txtTotalItem').value) || 0;

            // Logika untuk menghitung total nominal berdasarkan kategori dan total item
            var hargaPerItem = getHargaPerItem(kategori);
            var totalNominal = Math.round(totalItem *
                hargaPerItem); // Menggunakan Math.round untuk memastikan nilai integer

            // Tampilkan nilai yang diformat ke dalam elemen dengan id 'txtTotalNominal'
            var formattedNominal = (totalNominal);
            document.getElementById('txtTotalNominal').value = formattedNominal;
        }

        // Panggil fungsi updateTotal untuk menginisiasi perhitungan dan pemformatan
        updateTotal();

        function getHargaPerItem(kategori) {
            // Ganti dengan logika atau database untuk mendapatkan harga per item berdasarkan kategori
            switch (kategori) {
                case 'daging':
                    return 100000; // Harga per kilogram
                case 'seafood':
                    return 50000; // Harga per kilogram 
                case 'karbo':
                    return 25000;
                case 'sayur':
                    return 20000;
                case 'buah':
                    return 18000;
                case 'bumbu':
                    return 10000;
                case 'tepung':
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

            return prefix === undefined ? rupiah : prefix + rupiah;
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
                                        <option value="daging"
                                            {{ $tbl_pembelians->kategori == 'daging' ? 'selected' : '' }}>Daging</option>
                                        <option value="seafood"
                                            {{ $tbl_pembelians->kategori == 'seafood' ? 'selected' : '' }}>Seafood</option>
                                        <option value="karbo" {{ $tbl_pembelians->kategori == 'karbo' ? 'selected' : '' }}>
                                            Karbo</option>
                                        <option value="sayur" {{ $tbl_pembelians->kategori == 'sayur' ? 'selected' : '' }}>
                                            Sayur</option>
                                        <option value="buah" {{ $tbl_pembelians->kategori == 'buah' ? 'selected' : '' }}>
                                            Buah</option>
                                        <option value="bumbu" {{ $tbl_pembelians->kategori == 'bumbu' ? 'selected' : '' }}>
                                            Bumbu</option>
                                        <option value="tepung"
                                            {{ $tbl_pembelians->kategori == 'tepung' ? 'selected' : '' }}>Tepung</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="txtTotalItem">TOTAL ITEM</label>
                                    <input type="int" class="form-control" id="txtTotalItem"
                                        placeholder="Total Pembelian Item" onchange="updateTotal()" name="total_item"
                                        value="{{ $tbl_pembelians->total_item }}">
                                </div>

                                <div class="form-group">
                                    <label for="txtTotalNominal">TOTAL NOMINAL (Rp)</label>
                                    <input name="total_nominal" type="int" class="form-control" id="txtTotalNominal"
                                        readonly>
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
