@extends('layouts.master')

@section('addJavascript')
<script>
  const ctx = document.getElementById('myChart').getContext('2d');

  async function fetchData() {
    try {
      const response = await fetch('url_ke_endpoint_api_pengeluaran'); // Ganti dengan URL API atau endpoint yang sesuai
      const data = await response.json();

      // Memperbarui data chart dengan data yang diambil dari database
      myChart.data.datasets[0].data = data.pengeluaran;
      myChart.update(); // Mengupdate chart setelah data diubah
    } catch (error) {
      console.error('Error fetching data:', error);
    }
  }

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
      datasets: [{
        label: '#Pengeluaran',
        backgroundColor : [
          'rgba(255, 99, 132, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 99, 132, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 99, 132, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 99, 132, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 99, 132, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 99, 132, 0.2)',
          'rgba(54, 162, 235, 0.2)',
        ],
        data: [],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });

  async function fetchData() {
      try {
        const response = await fetch('url_ke_endpoint_api_pengeluaran');
        const data = await response.json();

        // Update chart data
        myChart.data.datasets[0].data = data.pengeluaran;
        myChart.update();
      } catch (error) {
        console.error('Error fetching data:', error);
      }
    }

    // Fetch data on page load
    fetchData();

  
</script>

@endsection

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="mdi mdi-home"></i>
                    </span>
                    Dashboard {{ Str::upper(Auth::user()->role) }}
                </h3>
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">
                            <span></span>Overview
                            <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
                  <div class="card card-statistics">
                    <div class="card-body">
                      <div class="clearfix">
                        <div class="float-start">
                          <i class="mdi mdi-account-multiple-plus text-danger icon-lg"></i>
                        </div>
                        <div class="float-end">
                          <p class="mb-0 text-right">Pengunjung</p>
                          <div class="fluid-container">
                            <h3 class="font-weight-medium text-right mb-0">
                              {{ $jumlahPengunjung ?? 'belum tersedia' }}
                            </h3>
                          </div>
                        </div>
                        
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
                  <div class="card card-statistics">
                    <div class="card-body">
                      <div class="clearfix">
                        <div class="float-start">
                          <i class="mdi mdi-book-minus text-danger icon-lg"></i>
                        </div>
                        <div class="float-end">
                          <p class="mb-0 text-right">Pengeluaran</p>
                          <div class="fluid-container">
                            <h3 class="font-weight-medium text-right mb-0">
                            @isset($totalPengeluaran)
                            Rp{{ number_format($totalPengeluaran, 0, ',', '.') }}
                            @else
                            Data tidak tersedia
                            @endisset
                            </h3>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-lg-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
                  <div class="card card-statistics">
                    <div class="card-body">
                      <div class="clearfix">
                        <div class="float-start">
                          <i class="mdi mdi-cash-usd text-danger icon-lg"></i>
                        </div>
                        <div class="float-end">
                          <p class="mb-0 text-right">Total Transaksi</p>
                          <div class="fluid-container">
                            <h4 class="font-weight-medium text-right mb-0">
                              @isset($totalTransaksi)
                              Rp{{ number_format($totalTransaksi, 0, ',', '.') }}
                              @else
                              Data tidak tersedia
                              @endisset
                          </h4>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                
                
                
                
            </div>
            <div class="row">
                <div class="col-md-7 grid-margin stretch-card">
                    <div class="card">
                    <div class="card-body">
                        <div class="clearfix">
                        <h4 class="card-title float-left">
                            Pengeluaran
                        </h4>
                        <div
                            id="visit-sale-chart-legend"
                            class="rounded-legend legend-horizontal legend-top-right float-right"
                        ></div>
                        </div>
                        <canvas id="myChart"></canvas>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
