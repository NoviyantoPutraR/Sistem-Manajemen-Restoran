<?php

namespace App\Http\Controllers;
use App\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::all(); // Ambil semua data menu
    return view('admin.menu.index', ['menus' => $menus]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.menu.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'menu' => 'required',
        'deskripsi' => 'required',
        'harga' => 'required',
        'total_item' => 'required',
        'total_transaksi' => 'required',
    ]);

    $menu = new Menu($validatedData);
    $menu->save();

    return redirect()->route('daftarMenu')->with('success', 'Menu berhasil ditambahkan');
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
    public function edit(Menu $menu)
    {
        return view('admin.menu.edit', [
            'menu' => $menu
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
{
    $validatedData = validator($request->all(), [
        'menu' => 'required|string|max:255', // Change 'nama' to 'menu'
        'deskripsi' => 'required|string', // Change 'deskripsi' to 'deks'
        'harga' => 'required', 
        'total_item' => 'required', // Change 'total item' to 'total_item'
        'total_transaksi' => 'required', // Change 'total transaksi' to 'total_transaksi'
    ])->validated();

    $menu->menu = $validatedData['menu'];
    $menu->deskripsi = $validatedData['deskripsi']; // Change 'deskripsi' to 'deks'
    $menu->harga = $validatedData['harga'];
    $menu->total_item = $validatedData['total_item']; // Change 'total item' to 'total_item'
    $menu->total_transaksi = $validatedData['total_transaksi']; // Change 'total transaksi' to 'total_transaksi'
    $menu->save();

    return redirect(route('daftarMenu'))->with('success', 'Data Berhasil Diupdate');
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect(route('daftarMenu'))->with('success', 'Data Berhasil Di hapus');;
    }
}

