<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $grafikPengeluaran = DB::table('tbl_pengeluarans')
        ->select(DB::raw('SUM(total) as total_per_month'), DB::raw('MONTH(created_at) as month'))
        ->groupBy(DB::raw('MONTH(created_at)'))
        ->get();



        return view('dashboard', compact('jumlahPengunjung', 'totalPengeluaran', 'totalTransaksi', 'totalPembelianBB', 'grafikPengeluaran'));


    }

}
