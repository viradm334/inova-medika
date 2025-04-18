<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use Illuminate\Http\Request;

class DetailPendaftaranController extends Controller
{
    public function index($id){
        $kunjungan = Kunjungan::findOrFail($id);

        return view('details', [
            'title' => 'Detail Kunjungan Pasien',
            'kunjungan' => $kunjungan
        ]);
    }
}
