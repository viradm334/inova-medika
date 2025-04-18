<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(10);

        return view('admin.pegawai.index', [
            'title' => 'Pegawai',
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = array_column(UserRole::cases(), 'value');
        return view('admin.pegawai.create', [
            'title' => 'Tambah Data Pegawai',
            'roles' => $roles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email:dns, rfc|unique:users',
            'password' => 'required|min:8|max:255',
            'role' => 'required'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        return redirect('/user')->with('success', 'Data pegawai berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $roles = array_column(UserRole::cases(), 'value');
        return view('admin.pegawai.show', [
            'title' => 'Detail Pegawai',
            'user' => $user,
            'roles' => $roles
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = array_column(UserRole::cases(), 'value');

        return view('admin.pegawai.edit', [
            'title' => 'Ubah Data Pegawai',
            'user' => $user,
            'roles' => $roles
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => 'required',
            'role' => 'required'
        ];

        if($request->email != $user->email){
            $rules['email'] = 'required|email:dns, rfc|unique:users';
        }

        $validatedData = $request->validate($rules);

        User::where('id', $user->id)->update($validatedData);

        return redirect('/user')->with('success', 'Data pegawai berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        User::destroy($user->id);

        return redirect('/user')->with('success', 'Pegawai berhasil dihapus!');
    }
}
