<?php

namespace App\Http\Controllers;

use App\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;


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
            'foto' => 'mimes:jpeg,png,jpg,gif,svg', // Atur sesuai kebutuhan Anda
            'menu' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required',
            'total_item' => 'required',
            'total_transaksi' => 'required',
        ]);

        // Upload dan resize foto
        $file = $request->file('foto');
        $name = 'FT' . date('Ymdhis') . '.' . $file->getClientOriginalExtension();
        $directory = 'image/foto/';

        // Membuat direktori jika belum ada
        if (!is_dir(public_path($directory))) {
            mkdir(public_path($directory), 0755, true);
        }

        $path = $directory . $name;

        // Menyimpan dan meresize foto
        $resize_foto = Image::make($file->getRealPath());
        $resize_foto->resize(200, 200, function ($constraint) {
            $constraint->aspectRatio();
        })->save(public_path($path));

        // Simpan data menu beserta nama file foto ke database
        $menu = new Menu([
            'foto' => 'image/foto/' . $name,
            'menu' => $validatedData['menu'],
            'deskripsi' => $validatedData['deskripsi'],
            'harga' => $validatedData['harga'],
            'total_item' => $validatedData['total_item'],
            'total_transaksi' => $validatedData['total_transaksi'],
        ]);

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
        $validator = Validator::make($request->all(), [
            'foto' => 'mimes:jpeg,png,jpg,gif,svg',
            'menu' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required',
            'total_item' => 'required',
            'total_transaksi' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('foto')) {
            if (File::exists(public_path($menu->foto))) {
                File::delete(public_path($menu->foto));
            }

            $file = $request->file('foto');
            $name = 'FT' . date('Ymdhis') . '.' . $file->getClientOriginalExtension();
            $directory = 'image/foto/';

            if (!is_dir(public_path($directory))) {
                mkdir(public_path($directory), 0755, true);
            }

            $path = $directory . $name;

            $resize_foto = Image::make($file->getRealPath());
            $resize_foto->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path($path));

            $menu->foto = $path;
        }

        $menu->menu = $request->input('menu');
        $menu->deskripsi = $request->input('deskripsi');
        $menu->harga = $request->input('harga');
        $menu->total_item = $request->input('total_item');
        $menu->total_transaksi = $request->input('total_transaksi');
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
