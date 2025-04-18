<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Tindakan;
use App\Models\Kunjungan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DokterController extends Controller
{
    public function index(){
        $kunjungans = Kunjungan::where('dokter_id', Auth::user()->id)->where('status', 'pending')->paginate(10);

        return view('dokter.index', [
            'title' => 'Dokter',
            'kunjungans' => $kunjungans
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

    public function arsipkunjungan(){
        $kunjungans = Kunjungan::where('dokter_id', Auth::user()->id)->where('status', 'finished')->paginate(10);

        return view('dokter.arsip', [
            'title' => 'Arsip Kunjungan',
            'kunjungans' => $kunjungans
        ]);
    }
}
