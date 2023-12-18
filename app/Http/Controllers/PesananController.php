<?php

namespace App\Http\Controllers;

use App\Meja;
use App\Menu;
use App\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pesanans = Pesanan::all();
        // return view('admin.pesanan.index', compact('pesananDineIns'));
        return view('admin.pesanan.index', compact('pesanans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menus = Menu::all();
        $mejas = Meja::all();

        return view('admin.pesanan.create', compact('menus', 'mejas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'kode_invoice' => 'required',
            'nama_pelanggan' => 'required',
            'status_pembayaran' => 'required|in:lunas,belum lunas',
            'status_pesanan' => 'required|in:belum diproses,sedang diproses,selesai',
            'menu_id' => 'required|exists:tbl_menus,id',
            'meja_id' => 'required|exists:tbl_mejas,id',
            'total_items' => 'required|integer|min:1',
            'total_nominal' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Set kode invoice dengan format INV-XXXXXXX
        $request->merge(['kode_invoice' => 'INV-' . Str::random(7)]);

        // Simpan pesanan ke dalam database
        Pesanan::create($request->all());

        return redirect()->route('daftarPesanan')->with('success', 'Pesanan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \app\Pesanan  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \app\Pesanan  $pesanan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pesanan $pesanan)
    {
        $pesanan = Pesanan::findOrFail($pesanan);
        $menus = Menu::all();
        $mejas = Meja::all();


        return view('admin.pesanan.index', compact('pesanan', 'menus', 'mejas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \app\Pesanan  $pesanan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pesanan $pesanan)
    {
        $request->validate([
            'status_pesanan' => 'required|in:belum diproses,sedang diproses,selesai',
        ]);

        // $pesanan = Pesanan::findOrFail($pesanan);
        $pesanan->status_pesanan = $request['status_pesanan'];
        $pesanan->update(['status_pesanan' => $request->status_pesanan]);

        return redirect()->route('daftarPesanan')->with('success', 'Status Pesanan berhasil diperbarui');
        // $request->validate([
        //     'status_pesanan' => 'required|in:belum diproses,sedang diproses,selesai',
        // ]);

        // $dineInOrder = Pesanan::findOrFail($pesanan);
        // $dineInOrder->update(['status_pesanan' => $request->status_pesanan]);

        // return response()->json(['message' => 'Status Pesanan diperbarui.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \app\Pesanan  $pesanan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pesanan $pesanan)
    {
        //
    }
}
