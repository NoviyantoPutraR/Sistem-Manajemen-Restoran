<?php

namespace App\Http\Controllers;

use App\PemesananModel;
use Illuminate\Http\Request;

class PemesananController extends Controller
{
    public function index()
    {
        $tbl_pembelians = PemesananModel::all();
        return view('admin.pemesanan.index', ['tbl_pembelians' => $tbl_pembelians
    ]);
    }

    public function store(Request $request)
    {
        $validateData = validator($request->all(), [
            
            'kategori' => 'required|string|max:255',
            'created_at' => 'required|string',
        ])->validate();

        $tbl_pembelians = new PemesananModel($validateData);
        $tbl_pembelians->save();

        return redirect(route('daftarPemesanan'))->with('success', 'Data Berhasil Disimpan');
    }

    public function update(Request $request, PemesananModel $tbl_pembelians)
    {
        $validateData = validator($request->all(), [
            'kategori' => 'required|string|max:255',
            'created_at' => 'required|string',
        ])->validate();

        $tbl_pembelians->kategori = $validateData['kategori'];
        $tbl_pembelians->created_at = $validateData['created_at'];
        $tbl_pembelians->save();

        return redirect(route('daftarPemesanan'))->with('success', 'Data Berhasil Di Update');
    }

    public function destroy(PemesananModel $tbl_pembelian)
    {
        $tbl_pembelian->delete();
        return redirect(route('daftarPemesanan'));
    }
    
    
}
