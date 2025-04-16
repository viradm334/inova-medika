<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Tindakan;
use App\Models\Kunjungan;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    public function index(){
        return view('dokter.index', [
            'title' => 'Dokter'
        ]);
    }

    public function checkinpage(){
        return view('dokter.checkin', [
            'title' => 'Check In Pasien'
        ]);
    }

    public function checkin(Request $request){
        $kunjungan = Kunjungan::findOrFail($request->id);
        $kunjungan->update(['status' => 'ongoing', 'waktu_checkin' => now()]);

        return redirect('/resep')->with('success', 'Pasien berhasil check in!');
    }

    public function resepobattindakan(){
        $obats = Obat::all();
        $tindakans = Tindakan::all();

        return view('dokter.resep', [
            'title' => 'Tambah Tindakan dan Resep Obat',
            'obats' => $obats,
            'tindakans' => $tindakans
        ]);
    }

    public function store(Request $request){

        $kunjungan = Kunjungan::findOrFail($request->id);
        $dataObat = [];

        $kunjungan->tindakans()->attach($request->tindakan);

        foreach ($request->obat as $index => $idObat) {
            $jumlah = $request->jumlah[$index];
            $dataObat[$idObat] = ['jumlah' => $jumlah];
        }
        
        $kunjungan->obats()->attach($dataObat);
        $kunjungan->update(['status' => 'finished', 'diagnosis' => $request->diagnosis, 'waktu_checkout' => now()]);

        return redirect()->back()->with('success', 'Resep berhasil dibuat!');
    }
}
