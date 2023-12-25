<?php

namespace App\Http\Controllers;

use App\PembelianModel;
use App\Pengeluaran;
use App\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tbl_pengeluarans = Pengeluaran::all();
        // return view('admin.pembelian.index', compact('tbl_pembelians'));
        return view('admin.pengeluaran.index', [
            'tbl_pengeluarans' => $tbl_pengeluarans
        ]);
    }

    public function laporan()
    {
        $totalNominalPesanans = Pesanan::select(DB::raw('SUM(total_nominal) as total_nominal'), DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"))
            ->groupBy('month')
            ->get();

        // Menghitung total nominal pengeluaran per bulan
        $totalNominalPengeluarans = Pengeluaran::select(DB::raw('SUM(total) as total_nominal'), DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"))
            ->groupBy('month')
            ->get();

        // Menghitung total nominal pembelian per bulan
        $totalNominalPembelians = PembelianModel::select(DB::raw('SUM(total_nominal) as total_nominal'), DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"))
            ->groupBy('month')
            ->get();

        // Menggabungkan data dari pembelian ke dalam $totalNominalPengeluarans
        foreach ($totalNominalPembelians as $pembelian) {
            $existingMonth = $totalNominalPengeluarans->firstWhere('month', $pembelian->month);

            if ($existingMonth) {
                $existingMonth->total_nominal += $pembelian->total_nominal;
            } else {
                $totalNominalPengeluarans->push($pembelian);
            }
        }

        return view('admin.pengeluaran.laporan', compact('totalNominalPesanans', 'totalNominalPengeluarans', 'totalNominalPembelians'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pengeluaran.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = validator($request->all(), [
            'jenis' => 'required',
            'deskripsi' => 'required',
            'total' => 'required',
        ])->validate();

        $tbl_pengeluarans = new Pengeluaran($validatedData);
        $tbl_pengeluarans->save();

        return redirect(route('daftarPengeluaran'))->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \app\Pengeluaran  $tbl_pengeluarans
     * @return \Illuminate\Http\Response
     */
    public function show(Pengeluaran $tbl_pengeluarans)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \app\Pengeluaran  $tbl_pengeluarans
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengeluaran $tbl_pengeluarans)
    {
        return view('admin.pengeluaran.edit', [
            'tbl_pengeluarans' => $tbl_pengeluarans,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \app\Pengeluaran  $tbl_pengeluarans
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengeluaran $tbl_pengeluarans)
    {
        $validatedData = validator($request->all(), [
            'jenis' => 'required',
            'deskripsi' => 'required',
            'total' => 'required',
        ])->validate();

        $tbl_pengeluarans->jenis = $validatedData['jenis'];
        $tbl_pengeluarans->deskripsi = $validatedData['deskripsi'];
        $tbl_pengeluarans->total = $validatedData['total'];
        $tbl_pengeluarans->save();

        return redirect(route('daftarPengeluaran'))->with('success', 'Data Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \app\Pengeluaran  $tbl_pengeluarans
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengeluaran $tbl_pengeluarans)
    {
        $tbl_pengeluarans->delete();
        return redirect(route('daftarPengeluaran'))->with('success', 'Data Berhasil Di hapus');
    }
}
