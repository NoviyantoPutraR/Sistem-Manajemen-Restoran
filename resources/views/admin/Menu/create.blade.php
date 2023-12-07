@extends('layouts.master')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark"><a href="{{ route('createMenu') }}">Tambah Menu</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
					<li class="breadcrumb-item active">Tambah Menu</li>
				</ol>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Form untuk menambahkan menu -->
                        <form action="{{ route('storeMenu') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="menu">Menu:</label>
                                <input type="text" class="form-control" id="menu" name="menu" required>
                            </div>

                            <div class="form-group">
                                <label for="kategori">Kategori:</label>
                                <input type="text" class="form-control" id="kategori" name="kategori" required>
                            </div>

                            <div class="form-group">
                                <label for="deskripsi">Deskripsi:</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="harga">Harga:</label>
                                <input type="text" class="form-control" id="harga" name="harga" required>
                            </div>

                            <div class="form-group">
                                <label for="total_transaksi">Total Transaksi:</label>
                                <input type="text" class="form-control" id="total_transaksi" name="total_transaksi" required>
                            </div>

                            <!-- Tombol untuk submit form -->
                            <button type="submit" class="btn btn-primary">Tambah Menu</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection
