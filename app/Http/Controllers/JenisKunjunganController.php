<?php

namespace App\Http\Controllers;

use App\Models\JenisKunjungan;
use Illuminate\Http\Request;

class JenisKunjunganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jenisKunjungans = JenisKunjungan::paginate(10);

        return view('admin.jeniskunjungan.index', [
            'title' => 'Jenis Kunjungan',
            'jenisKunjungans' => $jenisKunjungans
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.jeniskunjungan.create', [
            'title' => 'Tambah Jenis Kunjungan'
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

        JenisKunjungan::create($validatedData);

        return redirect('/jeniskunjungan')->with('success', 'Jenis kunjungan telah ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(JenisKunjungan $jenisKunjungan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JenisKunjungan $jeniskunjungan)
    {
        return view('admin.jeniskunjungan.edit', [
            'title' => 'Ubah Data Jenis Kunjungan',
            'jenisKunjungan' => $jeniskunjungan
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JenisKunjungan $jeniskunjungan)
    {
        $rules = [
            'harga' => 'required|numeric|min:0'
        ];

        if($request->nama != $jeniskunjungan->nama){
            $rules['nama'] = 'required|unique:tindakans';
        }

        $validatedData = $request->validate($rules);

        JenisKunjungan::where('id', $jeniskunjungan->id)->update($validatedData);

        return redirect('/jeniskunjungan')->with('success', 'Data jenis kunjungan berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JenisKunjungan $jeniskunjungan)
    {
        JenisKunjungan::destroy($jeniskunjungan->id);

        return redirect('/jeniskunjungan')->with('success', 'Jenis kunjungan berhasil dihapus!');
    }
}
