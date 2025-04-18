<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Regency;
use App\Models\Province;
use App\Models\Kunjungan;
use Illuminate\Http\Request;
use App\Models\JenisKunjungan;

class PendaftaranController extends Controller
{
    public function index(){
        $kunjungans = Kunjungan::paginate(10);

        return view('pendaftaran.index', [
            'title' => 'Pendaftaran Pasien',
            'kunjungans' => $kunjungans
        ]);
    }

    public function create(){

        $dokters = User::where('role', 'Dokter')->get();
        $jeniskunjungans = JenisKunjungan::all();
        $provinces = Province::all();
        $kotas = Regency::all();
        
        return view('pendaftaran.create', [
            'title' => 'Tambah Data Kunjungan',
            'dokters' => $dokters,
            'jeniskunjungans' => $jeniskunjungans,
            'provinces' => $provinces,
            'kotas' => $kotas
        ]);
    }

    public function store(Request $request){

        $validatedData = $request->validate([
            'nama_pasien' => 'required|string',
            'tgl_lahir' => 'required|date',
            'alamat' => 'required',
            'keluhan' => 'required',
            'kota_id' => 'required',
            'provinsi_id' => 'required',
            'no_hp' => 'required',
            'jenis_kunjungan_id' => 'required',
            'dokter_id' => 'required'
        ]);

        Kunjungan::create($validatedData);

        return redirect('/pendaftaran')->with('success', 'Kunjungan berhasil dibuat!');
    }

    public function show($id){

        $kunjungan = Kunjungan::findOrFail($id);
        $dokters = User::where('role', 'Dokter')->get();
        $jeniskunjungans = JenisKunjungan::all();
        $provinces = Province::all();
        $kotas = Regency::all();

        return view('pendaftaran.show', [
            'title' => 'Detail Kunjungan',
            'kunjungan' => $kunjungan,
            'dokters' => $dokters,
            'jeniskunjungans' => $jeniskunjungans,
            'provinces' => $provinces,
            'kotas' => $kotas
        ]);
    }
}
