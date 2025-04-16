<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use Illuminate\Http\Request;

class KasirController extends Controller
{
    public function index(){
        
        $kunjungans = Kunjungan::paginate(10);
        
        return view('kasir.index', [
            'title' => 'Kasir',
            'kunjungans' => $kunjungans
        ]);
    }

    public function paymentpage($id){

        $kunjungan = Kunjungan::with('obats', 'tindakans', 'jeniskunjungans')->findOrFail($id);
        $biaya_kunjungan = $kunjungan->jeniskunjungans->harga;
        $biaya_tindakan = $kunjungan->tindakans->sum('harga');
        $biaya_obat = $kunjungan->obats->sum(function($obat){
            return $obat->harga * $obat->pivot->jumlah;
        });
        $biaya_admin = 15000;
        $total = $biaya_admin + $biaya_kunjungan + $biaya_tindakan + $biaya_obat;
        $kunjungan->update(['total' => $total]);

        return view('kasir.payment', [
            'title' => 'Bayar Kunjungan',
            'kunjungan' => $kunjungan,
            'biaya_admin' => $biaya_admin,
            'biaya_kunjungan' => $biaya_kunjungan,
            'biaya_obat' => $biaya_obat,
            'biaya_tindakan' => $biaya_tindakan,
            'total' => $total
        ]);
    }

    public function pay(Request $request){

        $validatedData = $request->validate([
            'id' => 'required',
            'jumlah_bayar' => 'required|numeric|min:0'
        ]);

        $kunjungan = Kunjungan::findOrFail($request->id);

        $kembalian = $kunjungan->total - $request->jumlah_bayar;

        $kunjungan->update([
            'waktu_bayar' => now(),
            'jumlah_bayar' => $request->jumlah_bayar,
            'kembalian' => $kembalian,
            'payment_status' => 'paid'
        ]);

        return redirect('/kasir')->with('success', 'Berhasil bayar tagihan kunjungan!');
    }
}
