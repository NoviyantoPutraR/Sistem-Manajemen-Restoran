@extends('layouts.master')

@section('addJavascript')
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>

<script>
function setTunai() {
    var tunaiSetValue = document.getElementById("tunai_set").value;
    var tunaiElement = document.getElementById("tunai");

    // Set nilai Tunai Akhir dengan nilai yang dimasukkan pada Tunai Set
    tunaiElement.value = tunaiSetValue;

    // Calculate change when setting tunai
    calculateChange();
}

function calculateChange() {
    var tunai = document.getElementById("tunai").value;
    var harga_pesanan = document.getElementById("harga_pesanan").options[document.getElementById("harga_pesanan").selectedIndex].value;
    var kembali = parseInt(tunai) - parseInt(harga_pesanan);

    // Corrected ID to match the HTML
    document.getElementById("txtkembali").value = kembali;
}
function pengurangan() {
  var tunai = document.getElementById("tunai").value;
  var harga_pesanan = document.getElementById("harga_pesanan").options[document.getElementById("harga_pesanan").selectedIndex].value;
  var kembali = parseInt(tunai) - parseInt(harga_pesanan);

  // Corrected ID to match the HTML
  document.getElementById("txtkembali").value = kembali;
}
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
                        <h4 class="card-title">Pembayaran</h4><br>
                        <form method="#" action="{{ route('daftarPesanan') }}" class="forms-sample" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="harga_pesanan">Harga Pesanan :</label>
                                <select name="harga_pesanan" id="harga_pesanan" class="form-control" required>
                                    @foreach ($pesanans as $pesanan)
                                    <option value="{{ $pesanan->total_nominal }}">{{ $pesanan->total_nominal }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="tunai_set">Tunai:</label>
                                <div class="input-group">
                                    <input type="number" name="tunai_set" id="tunai_set" class="form-control" step="0.01" required>
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-gradient-primary me-2" onclick="setTunai()">Set</button>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="harga_akhir">Harga Akhir :</label>
                                <select name="harga_akhir" class="form-control" required>
                                    @foreach ($pesanans as $pesanan)
                                    <option value="{{ $pesanan->id }}">{{ $pesanan->total_nominal }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="tunai">Tunai :</label>
                                <input type="number" name="tunai" id="tunai" class="form-control" step="0.01" oninput="pengurangan()" required>
                            </div>

                            <div class="form-group">
                                <label for="kembali">Kembalian : </label>
                                <input type="text" name="kembali" class="form-control" id="txtkembali" readonly>
                            </div>

                            <button href="{{ route('daftarPesanan') }}"type="submit" class="btn btn-gradient-primary me-2">Bayar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- Form --}}
    </div>
</div>
@endsection
