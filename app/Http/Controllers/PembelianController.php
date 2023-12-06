<?php

namespace App\Http\Controllers;

use App\PembelianModel;
use Illuminate\Http\Request;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tbl_pembelians = PembelianModel::all();
        return view('admin.pembelian.index', compact('tbl_pembelians'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pembelian.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required', // Sesuaikan dengan nama atribut yang sesuai
            'total' => 'required|int',
        ]);

        // Simpan data ke dalam database
        PembelianController::create([
            'kategori' => $request->kategori,
            'total' => $request->total,
            // Sesuaikan dengan kolom-kolom yang sesuai dalam model dan database Anda
        ]);

        // Setelah menyimpan, alihkan pengguna atau lakukan tindakan lain yang sesuai
        return redirect()->route('daftarPembelian')->with('success', 'Pembelian berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
