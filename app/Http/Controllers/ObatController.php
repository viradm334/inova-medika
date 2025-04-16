<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $obats = Obat::paginate(10);

        return view('admin.obat.index', [
            'title' => 'Daftar Obat',
            'obats' => $obats
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.obat.create', [
            'title' => 'Tambah Obat'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:obats',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|numeric|min:0'
        ]);

        Obat::create($validatedData);

        return redirect('/obat')->with('success', 'Obat telah ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Obat $obat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Obat $obat)
    {
        return view('admin.obat.edit', [
            'title' => 'Ubah Data Obat',
            'obat' => $obat
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Obat $obat)
    {
        $rules = [
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|numeric|min:0'
        ];

        if($request->name != $obat->name){
            $rules['name'] = 'required|unique:obats';
        }

        $validatedData = $request->validate($rules);

        Obat::where('id', $obat->id)->update($validatedData);

        return redirect('/obat')->with('success', 'Data obat berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Obat $obat)
    {
        Obat::destroy($obat->id);

        return redirect('/obat')->with('success', 'Obat berhasil dihapus!');
    }
}
