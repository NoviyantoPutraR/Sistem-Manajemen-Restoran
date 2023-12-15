@extends('layouts.master')

@section('addJavascript')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // ... script JavaScript Anda ...
        });

        function updateTotal() {
            var harga = parseFloat(document.getElementById('harga').value) || 0;
            var totalItem = parseFloat(document.getElementById('txtTotalItem').value) || 0;

            // Logika untuk menghitung total nominal berdasarkan harga dan total item
            var totalTransaksi = totalItem * harga;

            // Format totalTransaksi ke dalam format rupiah tanpa tanda pemisah ribuan
            var formattedTransaksi = formatRupiah(totalTransaksi);

            // Set nilai formattedTransaksi ke input txtTotalTransaksi
            document.getElementById('txtTotalNominal').value = formattedTransaksi;

            // Set nilai totalTransaksi ke input hidden totalTransaksi untuk dikirimkan ke server
            document.getElementById('totalNominal').value = totalTransaksi;
        }

        function formatRupiah(angka) {
            var reverse = angka.toString().split('').reverse().join('');
            var ribuan = reverse.match(/\d{1,3}/g);
            var formatted = ribuan.join('.').split('').reverse().join('');
            return formatted;
        }

        var readFoto = function(event) {
            var input = event.target;
            var reader = new FileReader();
            reader.onload = function(){
                var dataURL = reader.result;
                var output = document.getElementById('output');
                output.src = dataURL;
            };
            reader.readAsDataURL(input.files[0]);
        };
    </script>
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
                            <a href="{{ route('daftarMenu') }}">Menu</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <span>Tambah Menu</span>
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
                            <form method="POST" action="{{ route('storeMenu') }}" class="forms-sample" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="foto">Foto</label><br>
                                    <input type="file" onchange="readFoto(event)" name="foto" class="form-control" id="foto" placeholder="Masukkan Nama Menu">
                                    <img id='output' style="width: 100px;">
                                </div>
                                
                                <div class="form-group">
                                    <label for="menuName">Menu</label><br>
                                    <input type="text" name="menu" class="form-control" id="menuName" placeholder="Masukkan Nama Menu">
                                </div>

                                <div class="form-group">
                                    <label for="description">Deskripsi</label>
                                    <textarea name="deskripsi" class="form-control" id="description" rows="3"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="harga">Harga</label>
                                    <input type="number" name="harga" class="form-control" id="harga" placeholder="Masukkan harga" onchange="updateTotal()">
                                </div>
                                <div class="form-group">
                                    <label for="txtTotalItem">Total Item</label>
                                    <input type="number" name="total_item" class="form-control" id="txtTotalItem" placeholder="Masukkan total item" onchange="updateTotal()">
                                </div>
                                <div class="form-group">
                                    <label for="txtTotalNominal">Total Transaksi</label>
                                    <input type="text" name="total_transaksi" class="form-control" id="txtTotalNominal" readonly>
                                    <input type="hidden" name="total_transaksi" id="totalNominal">
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
