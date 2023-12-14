<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tbl_users = User::all();
        return view('admin.user.index', compact('tbl_users'));
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.add');
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:tbl_users',
            'role' => 'required|in:admin,manager,employee',
            'password' => 'required|string|min:8|confirmed',
            ])->validate();

            $tbl_users = new User($validatedData);
            $tbl_users->save();
    
            return redirect(route('daftarUser'))->with('success', 'Data Berhasil Ditambahkan');
        }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $tbl_users)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $tbl_users)
    {
          return view('admin/user/edit', [
            'tbl_users' => $tbl_users
          ]);
    }
    public function cancelEdit()
    {
        // Logika pembatalan edit, jika diperlukan
        return redirect()->route('daftarUser'); // Gantilah dengan rute yang sesuai
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $tbl_users)
{
    $validatedData = validator($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:tbl_users',
        'role' => 'required|in:admin,manager,employee',
        'password' => 'required|string|min:8|confirmed',
    ])->validate();

    $tbl_users->name = $validatedData['name'];
    $tbl_users->email = $validatedData['email'];
    $tbl_users->role = $validatedData['role'];
    $tbl_users->password = $validatedData['password'];
    $tbl_users->save();

    return redirect(route('daftarUser'))->with('success', 'Data Berhasil Di Update');;
}
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $tbl_users)
    {
       $tbl_users->delete();
       return redirect(route('daftarUser'))->with('success', 'Data Berhasil Di Hapus');;
    }
}
