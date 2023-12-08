@extends('layouts.master')

@section('addJavascript')

@endsection

@section('content')
        <div class="main-panel">
          <div class="content-wrapper">
			{{-- content header --}}
            <div class="page-header">
              <h3 class="page-title">
                <span
                  class="page-title-icon bg-gradient-primary text-white me-2"
                >
                  <i class="mdi mdi-home"></i>
                </span>
                Pemesanan oleh {{ Str::upper(Auth::user()->role) }}
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                  <a href="{{ route('daftarPemesanan') }}">Pemesanan</a>
                  </li>
				  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>List Pemesanan
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
                    <div class="table-responsive">
						<table class="table table-hover table-striped mx-auto">
							<thead>
								<tr>
									<th style="width: 5%;">ID</th>
									<th style="width: 10%;">Meja</th>
									<th style="width: 10%;">Waktu</th>
									<th style="width: 10%;">Status</th>
									<th style="width: 10%;">Operator</th>
                  <th style="width: 5%;"></th>
								</tr>
							</thead>
							<tbody>
                @foreach ($tbl_pembelians as $tbl_pembelian)
									<tr>
										<td>{{ $loop->index + 1 }}</td>
										<td>{{ $tbl_pembelian->kategori }}</td>
										<td>{{ \Carbon\Carbon::parse($tbl_pembelian->created_at)->format('Y-m-d H:i:s') }}</td>
										<td></td>
										<td></td>
                    <td>
                      <a href="#" class="btn btn-gradient-warning btn-sm" role="button">Edit</a>
                      <a href="{{ route('deletePemesanan', ['id_pembelian'=> $tbl_pembelian->id_pembelian]) }}" 
                      class="btn btn-gradient-danger btn-sm" role="button">Hapus</a>
                    </td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>					
                  </div>
                </div>
              </div>
            </div>
			{{-- table --}}
          </div>
        </div>

@endsection

