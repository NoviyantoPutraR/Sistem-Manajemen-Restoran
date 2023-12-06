@extends('layouts.master')

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
									<th>ID</th>
									<th>Meja</th>
									<th>Waktu</th>
									<th>Status</th>
									<th>Operator</th>
								</tr>
							</thead>
							<tbody>
								
									<tr>
										<td>#</td>
										<td>#</td>
										<td>#</td>
										<td>#</td>
										<td>#</td>
									</tr>
								
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

