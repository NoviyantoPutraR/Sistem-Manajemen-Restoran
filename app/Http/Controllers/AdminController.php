<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\PembelianModel;
use App\Pengeluaran;
use App\Pesanan;


class AdminController extends Controller
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
            ->select(
                DB::raw('MONTH(tbl_pengeluarans.created_at) as month'),
                DB::raw('SUM(tbl_pengeluarans.total) + IFNULL(SUM(tbl_pembelians.total_nominal), 0) as total_per_month')
            )
            ->leftJoin('tbl_pembelians', function ($join) {
                $join->on(DB::raw('MONTH(tbl_pengeluarans.created_at)'), '=', DB::raw('MONTH(tbl_pembelians.created_at)'));
            })
            ->groupBy(DB::raw('MONTH(tbl_pengeluarans.created_at)'))
            ->get();

        $grafikPemasukan = DB::table('tbl_pesanans')
            ->select(
                DB::raw('MONTH(tbl_pesanans.created_at) as month'),
                DB::raw('SUM(tbl_pesanans.total_nominal) as total_per_month')
            )
            ->groupBy(DB::raw('MONTH(tbl_pesanans.created_at)'))
            ->get();


        return view('admin.dashboard', compact('jumlahPengunjung', 'totalPengeluaran', 'totalTransaksi', 'totalPembelianBB', 'grafikPengeluaran', 'grafikPemasukan'));
    }
}
