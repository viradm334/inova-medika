<?php

namespace App\Http\Controllers;

use App\Models\Tindakan;
use Illuminate\Http\Request;

class TindakanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tindakans = Tindakan::all();

        return view('admin.tindakan.index', [
            'title' => 'Data Tindakan',
            'tindakans' => $tindakans
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tindakan.create', [
            'title' => 'Tambah Tindakan'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|unique:tindakans',
            'harga' => 'required|numeric|min:0'
        ]);

        Tindakan::create($validatedData);

        return redirect('/tindakan')->with('success', 'Tindakan telah ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tindakan $tindakan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tindakan $tindakan)
    {
        return view('admin.tindakan.edit', [
            'title' => 'Ubah Data Tindakan',
            'tindakan' => $tindakan
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tindakan $tindakan)
    {
        $rules = [
            'harga' => 'required|numeric|min:0'
        ];

        if($request->nama != $tindakan->nama){
            $rules['nama'] = 'required|unique:tindakans';
        }

        $validatedData = $request->validate($rules);

        Tindakan::where('id', $tindakan->id)->update($validatedData);

        return redirect('/tindakan')->with('success', 'Data tindakan berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tindakan $tindakan)
    {
        Tindakan::destroy($tindakan->id);

        return redirect('/tindakan')->with('success', 'Tindakan berhasil dihapus!');
    }
}
