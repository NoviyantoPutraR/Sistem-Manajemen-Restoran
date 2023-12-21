<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Pelanggan;
use App\PembelianModel;
use App\Pengeluaran;
use App\Pesanan;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $jumlahPengunjung = Pesanan::count();
        $totalPengeluaran = Pengeluaran::sum('total');
        $totalTransaksi = Pesanan::sum('total_nominal');
        $totalPembelianBB = PembelianModel::sum('total_nominal');


        return view('admin.dashboard', compact('jumlahPengunjung', 'totalPengeluaran', 'totalTransaksi', 'totalPembelianBB'));
    }
}
